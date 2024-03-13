@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-8 text-center">Create a New Review</h1>

    <div class="w-full max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Game Title
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Enter game title" name="title" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                    Review Content
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" placeholder="Share your thoughts" name="content" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="rating">
                    Rating
                </label>
                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="rating" name="rating" required>
                    <option value="">Select a rating</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Review Image
                </label>
                <input type="file" id="image" name="image" accept="image/*" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="video" class="block text-gray-700 text-sm font-bold mb-2">Review Video (optional):</label>
                <input type="file" id="video" name="video" accept="video/*" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
    