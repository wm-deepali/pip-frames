<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Quote;
use Illuminate\Http\Request;

class CustomerEstimateController extends Controller
{
    public function index()
    {
        $customers = Customer::withCount('quotes')->get();

        return view('admin.customer_estimates.customers', compact('customers'));
    }

    public function detail($id)
    {
        $customer = Customer::with(['quotes', 'addresses.countryname', 'addresses.statename', 'addresses.cityname'])->findOrFail($id);
        // dd($customer->toArray());

        return view('admin.customer_estimates.customer_detail', compact('customer'));
    }


    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'msgText' => 'Customer not found.'
            ], 404);
        }

        try {
            $customer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Customer deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msgText' => 'Something went wrong while deleting the customer.'
            ], 500);
        }
    }

}
