<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'user'])->latest()->get();

        return view('blog.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        $blog->load(['category', 'user']);

        return view('blog.show', compact('blog'));
    }
}
