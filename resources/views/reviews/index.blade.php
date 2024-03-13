@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-semibold mb-6 text-center">Game Reviews</h1>
    
    @auth
        <div class="mb-6 text-right">
            <a href="{{ route('reviews.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Review
            </a>
        </div>
    @endauth

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($reviews as $review)
            <div class="max-w-sm rounded overflow-hidden shadow-lg flex flex-col justify-between h-full">
                @if ($review->image_path)
                    <img src="{{ asset('images/' . $review->image_path) }}" alt="Game image" class="w-full h-64 object-cover rounded-lg">
                @endif
                <div class="px-6 py-4 flex-grow">
                    <div class="font-bold text-xl mb-2">{{ $review->title }}</div>
                    <p class="text-gray-700 text-base">
                        {{ Str::limit($review->content, 150) }}
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Rating: {{ $review->rating }}</span>
                    <a href="{{ route('reviews.show', $review->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Read More
                    </a>
                </div>
                @auth
                    @if (auth()->user()->id === $review->user_id)
                        <div class="px-6 py-2 flex justify-center items-end">
                            <a href="{{ route('reviews.edit', $review->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Edit</a>
    
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this review?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        @empty
        @endforelse
    </div>    
</div>
@endsection
