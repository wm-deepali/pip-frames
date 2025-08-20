<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VatController extends Controller
{
    public function index()
    {
        $vats = Vat::all();
        return view('admin.manage-vat.index', compact('vats'));
    }

    public function create()
    {
        $view = view('admin.manage-vat.create')->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vats' => 'required|array|min:1',
            'vats.*.country' => 'required|in:United Kingdom,Ireland,Europe',
            'vats.*.vat_percentage' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        foreach ($request->vats as $index => $valueData) {
            $data = [
                'country' => $valueData['country'],
                'vat_percentage' => $valueData['vat_percentage'],
            ];
            // Save record
            Vat::create($data);
        }

        return $this->respondSuccess($request, 'Vats created successfully.');
    }



    public function edit($id)
    {
        $Vat = Vat::findOrFail($id);
        $view = view('admin.manage-vat.edit', ['Vat' => $Vat])->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function update(Request $request, $id)
    {
        $Vat = Vat::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'country' => 'required|in:United Kingdom,Ireland,Europe',
            'vat_percentage' => 'required|numeric|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $data = $request->only([
            'country',
            'vat_percentage',
        ]);

        $Vat->update($data);

        return $this->respondSuccess($request, 'Vat updated successfully.');
    }



    public function destroy($id)
    {
        $Vat = Vat::find($id);
        $Vat->delete();

        return request()->ajax()
            ? response()->json(['success' => true, 'message' => 'Vat deleted.'])
            : redirect()->route('admin.manage-vat.index')->with('success', 'Value deleted.');
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
            : redirect()->route('admin.manage-vat.index')->with('success', $message);
    }
}
