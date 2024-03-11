@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-wrap -mx-2">
        <!-- Video Container -->
        <div class="w-full md:w-2/3 px-2 mb-4">
            @if($review->video_path)
                <div class="rounded overflow-hidden shadow-lg">
                    <video width="100%" height="auto" controls>
                        @php
                            $videoType = 'video/' . pathinfo($review->video_path, PATHINFO_EXTENSION);
                        @endphp
                        <source src="{{ asset('videos/' . $review->video_path) }}" type="{{ $videoType }}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endif
        </div>
        <!-- Content Container -->
        <div class="w-full md:w-1/3 px-2 mb-4">
            <div class="mb-4">
                <h1 class="text-3xl font-semibold">{{ $review->title }}</h1>
                @php
                    $colors = ['1' => 'bg-red-500', '2' => 'bg-orange-300', '3' => 'bg-yellow-300', '4' => 'bg-green-300', '5' => 'bg-green-500'];
                @endphp
                <span class="text-xl {{ $colors[$review->rating] }} text-white font-bold py-1 px-2 rounded">
                    {{ $review->rating }}
                </span>
            </div>
            <div class="mb-4">
                <img src="{{ asset('images/' . $review->image_path) }}" alt="Game image" class="w-full object-cover rounded">
            </div>
            <div>
                <p class="text-gray-600">Reviewed by: {{ $review->user->name }}</p>
                <p class="text-sm text-gray-500">Published on: {{ $review->created_at->toFormattedDateString() }}</p>
            </div>
        </div>
    </div>
    <div class="mt-6 px-2">
        <p class="text-gray-700 whitespace-pre-line">{{ $review->content }}</p>
    </div>

    <div class="mt-6 px-2">
        <a href="{{ route('reviews.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Back</a>
    </div>
</div>
@endsection
