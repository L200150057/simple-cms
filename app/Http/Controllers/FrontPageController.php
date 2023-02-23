<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function index()
    {
        $posts = Post::with(['tags', 'categories'])->latest()->simplePaginate(6);
        $pinnedPosts = Post::with(['tags', 'categories'])->where('is_pinned', true)->get();

        return view('front-page.index', [
            'posts' => $posts,
            'pinnedPosts' => $pinnedPosts
        ]);
    }

    public function show(Post $post)
    {
        return view('front-page.show', [
            'post' => $post->load('tags', 'categories')
        ]);
    }
}
