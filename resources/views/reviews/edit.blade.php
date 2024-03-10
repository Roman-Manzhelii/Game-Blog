@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Edit Review</h1>
    
    <form method="POST" action="{{ route('reviews.update', $review->id) }}" class="w-full max-w-2xl bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Game Title</label>
            <input type="text" id="title" name="title" value="{{ $review->title }}" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" required>
        </div>

        <div class="mb-5">
            <label for="content" class="block mb-2 text-sm font-medium text-gray-700">Review Content</label>
            <textarea id="content" name="content" rows="4" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" required>{{ $review->content }}</textarea>
        </div>

        <div class="mb-5">
            <label for="rating" class="block mb-2 text-sm font-medium text-gray-700">Rating</label>
            <input type="number" id="rating" name="rating" value="{{ $review->rating }}" min="1" max="5" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Review</button>
        </div>
    </form>
</div>
@endsection
