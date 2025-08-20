<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactInfo;

class ContactInfoController extends Controller
{

    public function index()
    {
        $contact = ContactInfo::first();
        // dd($contact);
        return view('admin.info.index', compact('contact'));
    }


    public function create()
    {
        return view('admin.info.create');
    }

    public function store(Request $request)
    {
        // dd('her');
        $request->validate([
            'contact_number' => 'required|string|max:20',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|email',
            'website_url' => 'nullable|url',
            'full_address' => 'nullable|string',
            'location_map' => 'nullable|string',
            'show_on_header' => 'nullable|boolean',
        ]);

        ContactInfo::create($request->all());

        return redirect()->route('admin.header-contact.index')->with('success', 'Contact information saved successfully.');
    }
    public function edit()
    {
        $contact = ContactInfo::firstOrCreate([]);
        return view('admin.info.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'contact_number' => 'nullable|string',
            'show_on_header' => 'nullable|boolean',
            'mobile_number' => 'nullable|string',
            'email' => 'nullable|email',
            'full_address' => 'nullable|string',
            'location_map' => 'nullable|string',
            'website_url' => 'nullable|url',
        ]);

        $data['show_on_header'] = $request->has('show_on_header');

        ContactInfo::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Contact info updated successfully.');
    }
}
