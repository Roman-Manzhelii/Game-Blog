@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reviews</h1>
    
    @auth
        <a href="{{ route('reviews.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">Add New Review</a>
    @endauth

    @forelse ($reviews as $review)
        <div class="mb-4">
            <h2>{{ $review->title }}</h2>
            <p>{{ Str::limit($review->content, 150) }}</p>
            <p>Rating: {{ $review->rating }} / 5</p>
            <a href="{{ route('reviews.show', $review->id) }}" class="text-indigo-600">Read More</a>
        </div>
    @empty
        <p>No reviews yet.</p>
    @endforelse
</div>
@endsection
