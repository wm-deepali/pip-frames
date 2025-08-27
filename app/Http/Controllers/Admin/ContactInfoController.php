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
        $validated = $request->validate([
            'contact_number' => 'required|string|max:20',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|email',
            'website_url' => 'nullable|url',
            'full_address' => 'nullable|string',
            'show_on_header' => 'nullable|boolean',
            'show_on_footer' => 'nullable|boolean',
            'show_on_header_mobile' => 'nullable|boolean',
            'show_on_footer_mobile' => 'nullable|boolean',
            'show_on_header_email' => 'nullable|boolean',
            'show_on_footer_email' => 'nullable|boolean',
        ]);

        $validated['show_on_header'] = $request->has('show_on_header');
        $validated['show_on_footer'] = $request->has('show_on_footer');
        $validated['show_on_header_mobile'] = $request->has('show_on_header_mobile');
        $validated['show_on_footer_mobile'] = $request->has('show_on_footer_mobile');
        $validated['show_on_header_email'] = $request->has('show_on_header_email');
        $validated['show_on_footer_email'] = $request->has('show_on_footer_email');

        ContactInfo::create($validated);

        return redirect()->route('admin.header-contact.index')->with('success', 'Contact info saved successfully.');
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'contact_number' => 'nullable|string|max:20',
            'mobile_number' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'website_url' => 'nullable|url',
            'full_address' => 'nullable|string',
            'location_map' => 'nullable|string',
            'show_on_header' => 'nullable|boolean',
            'show_on_footer' => 'nullable|boolean',
            'show_on_footer_mobile' => 'nullable|boolean',
            'show_on_header_mobile' => 'nullable|boolean',
            'show_on_footer_email' => 'nullable|boolean',
            'show_on_header_email' => 'nullable|boolean',
        ]);

        $data['show_on_header'] = $request->has('show_on_header');
        $data['show_on_footer'] = $request->has('show_on_footer');
        $data['show_on_footer_mobile'] = $request->has('show_on_footer_mobile');
        $data['show_on_header_mobile'] = $request->has('show_on_header_mobile');
        $data['show_on_footer_email'] = $request->has('show_on_footer_email');
        $data['show_on_header_email'] = $request->has('show_on_header_email');

        ContactInfo::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Contact info updated successfully.');
    }


    public function edit()
    {
        $contact = ContactInfo::firstOrCreate([]);
        return view('admin.info.edit', compact('contact'));
    }


}
