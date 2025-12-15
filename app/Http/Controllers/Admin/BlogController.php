<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateBlog($request);
        $data['user_id'] = Auth::id();

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('status', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $this->validateBlog($request);
        $data['user_id'] = Auth::id();

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('status', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('status', 'Blog deleted successfully.');
    }

    protected function validateBlog(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image_url' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);
    }
}
