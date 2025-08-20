<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('admin.customer_estimates.manage-department', compact('departments'));
    }

    public function create()
    {
        return view('admin.customer_estimates.create-department');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        Department::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        // dd($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Department added.'
        ]);

    }


    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('admin.customer_estimates.edit-department', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
            'status' => $request->status
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Department Edited Successfully.'
        ]);
    }

    public function destroy($id)
    {
        Department::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Department deleted Successfully.'
        ]);
    }
}
