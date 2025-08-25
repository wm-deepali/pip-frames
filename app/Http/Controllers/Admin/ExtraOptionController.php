<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExtraOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtraOptionController extends Controller
{
    public function index()
    {
        $extraOptions = ExtraOption::orderBy('sort_order')->get();
        return view('admin.extra_options.index', compact('extraOptions'));
    }

    public function create()
    {
        return response()->json([
            'success' => true,
            'html' => view('admin.extra_options.create', [
                'action' => route('admin.extra_options.store'),
            ])->render(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'extra_options' => 'required|array',
            'extra_options.*.title' => 'required|string|max:255',
            'extra_options.*.price' => 'required|numeric|min:0',
            'extra_options.*.description' => 'nullable|string',
            'extra_options.*.code' => 'nullable|string',
            'extra_options.*.is_active' => 'required|boolean',
            'extra_options.*.sort_order' => 'nullable|integer',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->input('extra_options') as $option) {
                ExtraOption::create($option);
            }
        });

        return response()->json(['success' => true, 'message' => 'Options created!']);
    }

    public function edit($id)
    {
        $extra_option = ExtraOption::findOrFail($id);
        
        return response()->json([
            'success' => true,
            'html' => view('admin.extra_options.edit', [
                'extraOption' => $extra_option,
                'action' => route('admin.extra_options.update', $id),
            ])->render(),
        ]);
    }

    public function update(Request $request, ExtraOption $extra_option)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'code' => 'nullable|string',
            'is_active' => 'required|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $extra_option->update($request->only([
            'title',
            'price',
            'description',
            'code',
            'is_active',
            'sort_order',
        ]));

        return response()->json(['success' => true, 'message' => 'Option updated!']);
    }

    public function destroy(ExtraOption $extra_option)
    {
        $extra_option->delete();
        return response()->json(['success' => true, 'message' => 'Option deleted!']);
    }
}
