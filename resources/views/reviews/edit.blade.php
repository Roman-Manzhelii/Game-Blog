@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Edit Review</h1>

    @if ($errors->any())
    <div class="mb-4">
        <ul class="list-disc list-inside text-red-500">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


    <form method="POST" action="{{ route('reviews.update', $review->id) }}" enctype="multipart/form-data" class="w-full max-w-2xl bg-white rounded-lg shadow-md p-6">
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
            <input type="number" id="rating" name="rating" value="{{ $review->rating }}" min="1" max="100" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" required>
        </div>

        <div class="mb-5">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Game Image</label>
            @if($review->image_path)
                <div class="mb-4">
                    <img src="{{ asset('images/' . $review->image_path) }}" alt="Game image" class="w-full object-cover rounded">
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>

        <div class="mb-5">
            <label for="video" class="block mb-2 text-sm font-medium text-gray-700">Review Video (optional):</label>
            @if($review->video_path)
                <video width="320" height="240" controls>
                    <source src="{{ asset('videos/' . $review->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
            <input type="file" id="video" name="video" accept="video/*" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>
        
        <div class="mt-4 flex justify-between">
            <a href="{{ route('reviews.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Cancel</a>
            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Review</button>
        </div>
    </form>
</div>
@endsection