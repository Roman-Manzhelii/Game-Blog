@extends('layouts.app')

@section('content')
<style>
    .game-image {
        max-height: 800px;
    }

</style>

<div class="mx-auto px-4 py-8" style="background-color: #131313">
    <h1 class="text-3xl font-semibold mb-8 text-white">Edit Review</h1>
    <div class="w-full max-w-2xl mx-auto p-6 rounded-lg shadow-md" style="background-color: #333">
        <form method="POST" action="{{ route('reviews.update', $review->id) }}" enctype="multipart/form-data" class="w-full max-w-2xl p-6" style="background-color: #333">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block mb-2 font-bold text-gray-200">Game Title</label>
                <input type="text" id="title" name="title" value="{{ $review->title }}" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block mb-2 font-bold text-gray-200">Review Content</label>
                <textarea id="content" name="content" rows="4" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" required>{{ $review->content }}</textarea>
            </div>

            <div class="mb-4">
                <label for="rating" class="block mb-2 font-bold text-gray-200">Rating</label>
                <input type="number" id="rating" name="rating" value="{{ $review->rating }}" min="1" max="100" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" required>
            </div>

            <div class="mb-4">
                <label for="image" class="block mb-2 font-bold text-gray-200">Game Image</label>
                @if($review->image_path)
                    <div class="mb-4">
                        <img src="{{ asset('images/' . $review->image_path) }}" alt="" class="game-image w-full object-cover rounded ">
                    </div>
                @endif
                <input type="file" id="image" name="image" accept="image/*" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>

            <div class="mb-4">
                <label for="video" class="block mb-2 font-bold text-gray-200">Review Video (optional):</label>
                @if($review->video_path)
                    <video width="100%" height="auto" controls class="w-full object-cover rounded">
                        <source src="{{ asset('videos/' . $review->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif
                <input type="file" id="video" name="video" accept="video/*" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
            </div>
            
            <div class="flex items-center justify-between">
                <a href="{{ route('reviews.index') }}" 
                class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 
                    transform bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-white">Cancel
                </a>
                <button type="submit" 
                    class="px-6 py-2 leading-5 text-white transition-colors duration-200
                     transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection