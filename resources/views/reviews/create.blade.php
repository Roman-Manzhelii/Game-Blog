@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a Review</h1>
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <div>
            <label for="title">Game Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="content">Review Content:</label>
            <textarea name="content" id="content" required></textarea>
        </div>

        <div>
            <label for="rating">Rating:</label>
            <input type="number" name="rating" id="rating" min="1" max="5" required>
        </div>

        <div>
            <button type="submit">Submit Review</button>
        </div>
    </form>
</div>
@endsection


