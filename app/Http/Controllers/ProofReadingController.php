<?php

namespace App\Http\Controllers;

use App\Models\ProofReading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProofReadingController extends Controller
{
    public function index()
    {
        $proofReading = ProofReading::latest()->get();
        return view('admin.proof-reading.index', compact('proofReading'));
    }

    public function create()
    {
        $view = view('admin.proof-reading.create')->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proof_readings' => 'required|array|min:1',
            'proof_readings.*.proof_type' => 'required|string|max:255',
            'proof_readings.*.price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        foreach ($request->proof_readings as $index => $valueData) {
            $data = [
                'proof_type' => $valueData['proof_type'],
                'price' => $valueData['price'],
            ];
            // Save record
            ProofReading::create($data);
        }

        return $this->respondSuccess($request, 'Proof Readings created successfully.');
    }



    public function edit($id)
    {
        $ProofReading = ProofReading::findOrFail($id);
        $view = view('admin.proof-reading.edit', ['ProofReading'=> $ProofReading])->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }


    public function update(Request $request, $id)
    {
        $ProofReading = ProofReading::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'proof_type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->validationError($validator);
        }

        $data = $request->only([
            'proof_type',
            'price',
        ]);

        $ProofReading->update($data);

        return $this->respondSuccess($request, 'Proof Reading updated successfully.');
    }



    public function destroy(ProofReading $proofReading)
    {
        $proofReading->delete();

        return request()->ajax()
            ? response()->json(['success' => true, 'message' => 'Proof reading deleted.'])
            : redirect()->route('admin.proof-reading.index')->with('success', 'Value deleted.');
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
            : redirect()->route('admin.proof-reading.index')->with('success', $message);
    }
}
