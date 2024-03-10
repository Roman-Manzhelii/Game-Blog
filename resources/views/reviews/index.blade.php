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
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="./images/top25modernpcgames-slideshow-1663951022529.jpg" alt="Game image">
                <div class="px-6 py-4">
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
            </div>
        @empty
            <p class="text-center text-gray-500">No reviews yet.</p>
        @endforelse
    </div>
</div>
@endsection
