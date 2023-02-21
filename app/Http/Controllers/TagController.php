<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index');
    }

    public function list()
    {
        return datatables()
            ->eloquent(
                Tag::latest()
            )
            ->addColumn('action', function (Tag $tag) {
                return '
                    <a href="' . route('tag.edit', $tag->id) . '" type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-pen"></i>
                    </a>
                    <form onsubmit="destroy(event)" class="d-inline-block" action="' . route('tag.destroy', $tag->id) . '" method="POST">
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
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable',
        ]);

        Tag::create($validatedData + [
            'created_by' => auth()->user()->name
        ]);

        return redirect()->route('tag.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('tag.edit', [
            'tag' => $tag
        ]);
    }

    public function update(Request $request, Tag $tag)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable',
        ]);

        $tag->update($validatedData);

        return redirect()->route('tag.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json([
            'message' => 'Tag deleted successfully.'
        ]);
    }
}
