<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index');
    }

    public function list()
    {
        return datatables()
            ->eloquent(
                Post::latest()
            )
            ->addColumn('action', function (Post $post) {
                return '
                    <a href="' . route('post.edit', $post->id) . '" type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-pen"></i>
                    </a>
                    <form onsubmit="destroy(event)" class="d-inline-block" action="' . route('post.destroy', $post->id) . '" method="POST">
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
        return view('post.create', [
            'tags' => Tag::latest()->get(),
            'categories' => Category::latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,svg,png',
            'tags' => 'nullable',
            'categories' => 'nullable'
        ]);

        $postData = Arr::except($validatedData, ['tags', 'categories', 'image']);
        $postData = array_merge($postData, [
            'created_by' => $request->user()->name,
            'image' => $request->file('image')->storeAs('/', $request->file('image')->hashName(), [
                'disk' => 'public'
            ])
        ]);

        $post = Post::create($postData);

        $post->tags()->attach($request->tags);
        $post->categories()->attach($request->categories);

        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'tags' => Tag::latest()->get(),
            'categories' => Category::latest()->get(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable',
            'tags' => 'nullable',
            'categories' => 'nullable'
        ]);

        $postData = Arr::except($validatedData, ['tags', 'categories', 'image']);

        if ($request->hasFile('image')) {
            $postData = array_merge($postData, [
                'image' => $request->file('image')->storeAs('/', $request->file('image')->hashName(), [
                    'disk' => 'public'
                ])
            ]);
        }

        $post->update($postData);
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);

        return redirect()->route('post.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully.'
        ]);
    }
}
