@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <a href="{{ route('blogs.index') }}" class="btn btn-link text-success mb-3">← Back to blog</a>

    <div class="card">
        <img src="{{ asset($blog->image_url) }}" class="card-img-top" alt="{{ $blog->title }}">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge badge-success">{{ $blog->category->name ?? 'Uncategorized' }}</span>
                <small class="text-muted">Published {{ $blog->created_at?->format('M d, Y') }}</small>
            </div>
            <h2 class="card-title">{{ $blog->title }}</h2>
            <p class="text-muted mb-2">By {{ $blog->user->name ?? 'Guest author' }}</p>
            @if($blog->name)
                <p class="text-muted">Reference: {{ $blog->name }}</p>
            @endif

            <div class="mt-4">
                {!! $blog->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
