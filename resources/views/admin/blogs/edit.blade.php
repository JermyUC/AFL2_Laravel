@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Edit Blog Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blogs.update', $blog) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="name">Reference Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $blog->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="image_url">Image URL</label>
            <input type="text" name="image_url" id="image_url" class="form-control" value="{{ old('image_url', $blog->image_url) }}" required>
        </div>

        <div class="form-group mb-4">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control rich-text-editor" rows="10">{{ old('content', $blog->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-link">Cancel</a>
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.rich-text-editor',
        menubar: false,
        height: 400,
        toolbar: 'undo redo | styles | bold italic underline | bullist numlist | link',
        plugins: 'link lists',
    });
</script>
@endsection
