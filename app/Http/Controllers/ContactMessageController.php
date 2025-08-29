<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{

    public function index()
    {
        $ContactMessage = ContactMessage::all();
        return view('admin.enquires.index', compact('ContactMessage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_name' => 'required|string|max:255',
            'form_email' => 'required|email',
            'form_phone' => 'nullable|string|max:20',
            'form_subject' => 'nullable|string|max:255',
            'form_selected_subject' => 'nullable|string|max:255',
            'form_message' => 'required|string',
        ]);

        ContactMessage::create([
            'name' => $request->form_name,
            'email' => $request->form_email,
            'phone' => $request->form_phone,
            'subject' => $request->form_subject,
            'selected_subject' => $request->form_selected_subject,
            'selected_subject' => $request->form_message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your message has been sent successfully!',
        ]);
    }
}
