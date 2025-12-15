@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Manage Blogs</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">Create Blog</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Created</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->category->name ?? 'Uncategorized' }}</td>
                                <td>{{ $blog->user->name ?? 'Guest' }}</td>
                                <td>{{ $blog->created_at?->format('M d, Y') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('blogs.show', $blog) }}" class="btn btn-sm btn-outline-secondary">View</a>
                                    <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this blog post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted p-3">No blog posts yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
