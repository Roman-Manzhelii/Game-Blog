@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Update Review</h1>
    
    <form method="POST" action="{{ route('reviews.update', $review->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Game Title:</label>
            <input type="text" name="title" value="{{ $review->title }}" id="title" required>
        </div>

        <div>
            <label for="content">Review Content:</label>
            <textarea name="content" id="content" required>{{ $review->content }}</textarea>
        </div>

        <div>
            <label for="rating">Rating:</label>
            <input type="number" name="rating" value="{{ $review->rating }}" id="rating" min="1" max="5" required>
        </div>

        <div>
            <button type="submit">Update Review</button>
        </div>
    </form>
</div>
@endsection
