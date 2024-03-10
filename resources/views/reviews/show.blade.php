@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h1>{{ $review->title }}</h1>
        <p>{{ $review->content }}</p>
        <p>Rating: {{ $review->rating }} / 5</p>
        <p>Review by: {{ $review->user->name }}</p>
        <p>Posted on: {{ $review->created_at->format('m/d/Y') }}</p>
        <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
