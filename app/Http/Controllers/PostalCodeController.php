<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostalCodeController extends Controller
{

    public function index()
    {
        $postalCodes = PostalCode::latest()->get();
        return view('admin.postal-code.index', compact('postalCodes'));
    }


    public function edit($id)
    {
        $PostalCode = PostalCode::findOrFail($id);
        $view = view('admin.postal-code.edit', ['PostalCode' => $PostalCode])->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function update(Request $request, $id)
    {
        $postalCode = PostalCode::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'is_serviceable' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()]);
        }

        $postalCode->is_serviceable = $request->input('is_serviceable');
        $postalCode->save();

        return response()->json(['success' => true, 'message' => 'Postal code updated successfully.']);
    }



    // 🔄 Helper for validation failure
    private function validationError($validator)
    {
        return response()->json([
            'success' => false,
            'code' => 422,
            'errors' => $validator->errors(),
        ]);
    }

    // ✅ Helper for success redirect or JSON
    private function respondSuccess(Request $request, string $message)
    {
        return $request->ajax()
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->route('admin.postal-code.index')->with('success', $message);
    }
}
