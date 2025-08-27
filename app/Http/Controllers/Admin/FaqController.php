<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = Faq::latest()->get(); // Fetch FAQs ordered by latest
        return view('admin.content.faq', compact('faqs'));
    }
    public function store(Request $request)
    {
        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = $request->status;
        $faq->save();

        return response()->json(['success' => true, 'message' => 'FAQ added successfully!']);
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($request->only(['question', 'answer', 'status']));
        return response()->json(['success' => true, 'message' => 'FAQ updated successfully.']);
    }

    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        return response()->json(['success' => true, 'message' => 'FAQ deleted successfully.']);
    }


    public function publicIndex()
    {
        $faqs = Faq::where('status', 'published')->get();
        $contact = ContactInfo::first();
        return view('front.faq', compact('faqs', 'contact'));
    }
}
