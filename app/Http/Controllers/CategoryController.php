<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index');
    }

    public function list()
    {
        return datatables()
            ->eloquent(
                Category::latest()
            )
            ->addColumn('action', function (Category $category) {
                return '
                    <a href="' . route('category.edit', $category->id) . '" type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-pen"></i>
                    </a>
                    <form onsubmit="destroy(event)" class="d-inline-block" action="' . route('category.destroy', $category->id) . '" method="POST">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->addIndexColumn()
            ->escapeColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable',
        ]);

        Category::create($validatedData + [
            'created_by' => auth()->user()->name
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable',
        ]);

        $category->update($validatedData);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully.'
        ]);
    }
}
