@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Blog</h2>
            <p class="text-muted mb-0">Stories and tips from the carnivorous plant community.</p>
        </div>
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-success">New Post</a>
            @endif
        @endauth
    </div>

    <div class="row">
        @forelse ($blogs as $blog)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset($blog->image_url) }}" class="card-img-top" alt="{{ $blog->title }}">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge badge-success">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                            <small class="text-muted">{{ $blog->created_at?->format('M d, Y') }}</small>
                        </div>
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="text-muted small mb-2">By {{ $blog->user->name ?? 'Guest' }}</p>
                        <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 110) }}</p>
                        <a href="{{ route('blogs.show', $blog) }}" class="btn btn-outline-success btn-sm mt-auto">Read more</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <p class="mb-0">No blog posts yet. Check back soon!</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
