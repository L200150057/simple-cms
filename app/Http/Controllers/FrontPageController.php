<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        $posts = Post::with(['tags', 'categories'])->latest()->simplePaginate(6);

        return view('welcome', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return $post;
    }
}
