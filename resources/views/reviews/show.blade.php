@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white p-6 rounded shadow">
        <h1 class="text-3xl font-semibold mb-4">{{ $review->title }}</h1>
        @if($review->image_path)
            <div class="mb-4">
                <img src="{{ asset('images/' . $review->image_path) }}" alt="Game image" class="w-full object-cover rounded">
            </div>
        @endif
        <p class="text-gray-700 whitespace-pre-line">{{ $review->content }}</p>
        <p class="text-gray-700 mb-4">Rating: {{ $review->rating }} / 5</p>
        <p>Reviewed by: {{ $review->user->name }}</p>
        <p class="text-sm text-gray-500">Published on: {{ $review->created_at->toFormattedDateString() }}</p>
        @auth
            @if (auth()->user()->id === $review->user_id)
                <div class="flex items-center mt-4">
                    <a href="{{ route('reviews.edit', $review->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Edit</a>

                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                    </form>
                </div>
            @endif
        @endauth
    </div>
</div>
@endsection
