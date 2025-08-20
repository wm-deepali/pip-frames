<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Invoice;
use App\Models\Quote;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class QuoteController extends Controller
{


    public function index()
    {
        // All pending quotes
        $quotes = Quote::with(['customer', 'deliveryAddress', 'items.subcategory.categories'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        // Approved quotes 
        $approvedQuotes = Quote::with(['customer', 'departments', 'deliveryAddress', 'items.subcategory.categories', 'payments'])
            ->where('status', 'approved')
            ->get();

        // canceled quotes 
        $canceledQuotes = Quote::with(['customer', 'departments', 'deliveryAddress', 'items.subcategory.categories', 'payments'])
            ->where('status', 'cancelled')
            ->get();


        // Approved + processed quotes (with departments)
        $processedQuotes = Quote::with(['departments', 'customer', 'deliveryAddress', 'items.subcategory.categories', 'payments'])
            ->where('status', 'approved')
            ->whereHas('departments') // Assigned to at least one department
            ->get();

        // Group processed quotes by department
        $departmentQuotes = [];

        foreach ($processedQuotes as $quote) {
            // Get the latest department (by created_at or id or pivot timestamp)
            $latestDepartment = $quote->departments->sortByDesc('pivot.created_at')->first();

            if ($latestDepartment) {
                $departmentQuotes[$latestDepartment->id][] = $quote;
            }
        }


        $departments = Department::all();

        return view('admin.quotes.orders', compact(
            'quotes',
            'approvedQuotes',
            'canceledQuotes',
            'departmentQuotes',
            'departments'
        ));
    }




    public function show($id)
    {
        $quote = Quote::with([
            'customer',
            'items.attributes.attribute',
            'items.attributes.attributeValue',
            'documents',
            'deliveryAddress',
            'departments' // eager load existing departments
        ])->findOrFail($id);

        // Get all departments
        $departments = Department::all();

        // Get IDs of already assigned departments
        $assignedDepartmentIds = $quote->departments->pluck('id')->toArray();

        // Exclude assigned departments
        $availableDepartments = $departments->reject(function ($dept) use ($assignedDepartmentIds) {
            return in_array($dept->id, $assignedDepartmentIds);
        });

        return view('admin.quotes.index', [
            'quote' => $quote,
            'departments' => $availableDepartments,
        ]);
    }



    public function downloadPdf($id)
    {
        $quote = Quote::with([
            'customer',
            'items.subcategory.categories',
            'items.attributes.attribute',
            'items.attributes.attributeValue',
            'deliveryAddress',
            'documents',
            'payments'
        ])->findOrFail($id);

        $pdf = Pdf::loadView('admin.quotes.pdf', compact('quote'))
            ->setPaper('A4', 'portrait')  // Force A4 and portrait
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true); // Needed if loading local images
        return $pdf->download('Quote_' . $quote->quote_number . '.pdf');
    }


    public function updateStatus(Request $request)
    {
        $request->validate([
            'quote_id' => 'required|exists:quotes,id',
            'status' => 'required|in:approved,cancelled,process',
            'department' => 'nullable|string'
        ]);

        $quote = Quote::findOrFail($request->quote_id);
        $quote->status = $request->status;

        if ($request->status === 'approved') {
            // Generate unique 7-digit order number if not already set
            if (!$quote->order_number) {
                $quote->order_number = $this->generateUniqueOrderNumber();
            }

            // Save the quote first
            $quote->save();

            return response()->json([
                'success' => true,
                'message' => 'Quote approved and invoice generated successfully.',
                'order_number' => $quote->order_number,
            ]);
        }

        $quote->save();

        return response()->json([
            'success' => true,
            'message' => 'Quote status updated successfully.',
            'order_number' => $quote->order_number,
        ]);
    }


    public function processToDepartment(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'quote_id' => 'required|exists:quotes,id',
            'department_id' => 'required|exists:departments,id',
            'notes' => 'nullable|string',
        ]);

        $quote = Quote::findOrFail($request->quote_id);

        // Prevent duplicate assignment to same department
        if ($quote->departments()->where('department_id', $request->department_id)->exists()) {
            return response()->json(['message' => 'This quote has already been sent to the selected department.'], 422);
        }

        $quote->departments()->attach($request->department_id, [
            'notes' => $request->notes,
        ]);

        return response()->json(['message' => 'Quote successfully assigned to department.']);
    }


    public function updateNote(Request $request)
    {
        $request->validate([
            'quote_id' => 'required|exists:quotes,id',
            'department_id' => 'required|exists:departments,id',
            'notes' => 'nullable|string',
        ]);

        $quote = Quote::findOrFail($request->quote_id);

        // Update pivot table note
        $quote->departments()->updateExistingPivot($request->department_id, [
            'notes' => $request->notes,
            'updated_at' => now()
        ]);

        return response()->json(['success' => true, 'message' => 'Note updated successfully.']);
    }



    public function submitPayment(Request $request)
    {
        $request->validate([
            'quote_id' => 'required|exists:quotes,id',
            'amount_received' => 'required|numeric|min:0.01',
            'payment_type' => 'required|string',
            'payment_method' => 'required|string',
            'payment_date' => 'required|date',
            'reference_number' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:1000',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $quote = Quote::findOrFail($request->quote_id);

        // Store payment proof if uploaded
        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        // 🔁 Generate invoice if not already generated
        $invoice = $quote->invoice;
        if (!$invoice) {
            $invoice = $this->generateInvoiceForQuote($quote);
        }

        // Save payment
        $quote->payments()->create([
            'invoice_id' => $invoice->id,
            'amount_received' => $request->amount_received,
            'payment_method' => $request->payment_method,
            'payment_date' => $request->payment_date,
            'reference_number' => $request->reference_number,
            'remarks' => $request->remarks,
            'payment_proof' => $proofPath,
            'payment_type' => $request->payment_type,
        ]);

        // 🔁 Mark invoice as paid if fully paid
        $totalPaid = $quote->payments()->sum('amount_received');
        if ($totalPaid >= $invoice->total_amount) {
            $invoice->is_paid = true;
            $invoice->save();
        }

        return response()->json(['success' => true, 'message' => 'Payment submitted successfully.']);
    }


    public function viewInvoice($quoteId)
    {
        $quote = Quote::with([
            'customer',
            'billingAddress',
            'deliveryAddress',
            'items.attributes.attribute',
            'items.attributes.attributeValue',
            'payments',
            'invoice'
        ])->findOrFail($quoteId);
        return view('admin.quotes.view-invoice', [
            'quote' => $quote,
            'invoice' => $quote->invoice,
            'payments' => $quote->payments,
            'customer' => $quote->customer,
        ]);
    }


    public function downloadInvoice($quoteId)
    {
        $quote = Quote::with([
            'customer',
            'billingAddress',
            'deliveryAddress',
            'items.attributes.attribute',
            'items.attributes.attributeValue',
            'payments',
            'invoice'
        ])->findOrFail($quoteId);

        $pdf = Pdf::loadView('admin.quotes.down-invoice', [
            'quote' => $quote,
            'invoice' => $quote->invoice,
            'payments' => $quote->payments,
            'customer' => $quote->customer,
        ])
            ->setPaper('A4', 'portrait')  // Force A4 and portrait
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true); // Needed if loading local images

        return $pdf->download('invoice-' . $quote->invoice->invoice_number . '.pdf');
    }

    protected function generateUniqueOrderNumber()
    {
        do {
            $number = mt_rand(1000000, 9999999); // Generate 7-digit number
            $orderNumber = $number;
        } while (Quote::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }



    /**
     * Generate invoice for given quote
     */
    protected function generateInvoiceForQuote(Quote $quote)
    {
        $invoice = new Invoice();
        $invoice->quote_id = $quote->id;
        $invoice->total_amount = $quote->grand_total;
        $invoice->invoice_date = now();
        $invoice->invoice_number = $this->generateUniqueInvoiceNumber();
        $invoice->is_paid = false;

        $invoice->save();

        return $invoice;
    }


    protected function generateUniqueInvoiceNumber()
    {
        do {
            $number = 'INV-' . mt_rand(100000, 999999); // e.g. INV-123456
        } while (Invoice::where('invoice_number', $number)->exists());

        return $number;
    }


}
