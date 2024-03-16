@extends('layouts.app')

@section('content')

<style>
    .game-image {
        max-height: 500px;
    }

    .guide-content {
    background-color: #333;
    color: #ccc; 
    padding: 1rem; 
    border-radius: 0.5rem;
}

    /* Стилі для контенту гайду */
    .guide-content h1, .guide-content h2, .guide-content h3, .guide-content h4, .guide-content h5, .guide-content h6 {
        font-weight: bold;
        color: #ffffff;
    }

    .guide-content h1 {
        font-size: 2.25rem; /* 36px */
    }

    .guide-content h2 {
        font-size: 1.875rem; /* 30px */
    }

    .guide-content h3 {
        font-size: 1.5rem; /* 24px */
    }

    .guide-content h4 {
        font-size: 1.375; 
    }

    .guide-content h5 {
        font-size: 1.250rem; 
    }

    .guide-content h6 {
        font-size: 1.125rem; 
    }

    .guide-content p {
        font-size: 1rem; /* 16px */
        margin-bottom: 1rem;
    }

    .guide-content a {
        color: #4e9af1;
        text-decoration: none;
    }

    .guide-content a:hover {
        color: #a1c9f1;
        text-decoration: underline;
    }

    /* Стилі для зображень */
    .guide-content img {
        max-width: 100%;
        height: auto;
    }

</style>

<div class="min-h-screen" style="background-color: #131313">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-5xl font-bold italic uppercase tracking-wide text-center text-white mb-8">{{ $guide->title }}</h1>

        <div class="flex flex-wrap -mx-2">
            <!-- Video or Placeholder Container -->
            <div class="w-full lg:w-2/3 px-2 mb-4">
                @if(isset($guide->firstVideo->path))
                    <div class="rounded overflow-hidden shadow-lg bg-white">
                        <video width="100%" height="auto" controls>
                            @php
                                $videoType = 'video/' . pathinfo($guide->firstVideo->path, PATHINFO_EXTENSION);
                            @endphp
                            <source src="{{ asset('videos/' . $guide->firstVideo->path) }}" type="{{ $videoType }}">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @else
                    <div class="rounded overflow-hidden shadow-lg bg-white">
                        <video width="100%" height="auto" controls>
                            <source src="{{ asset('videos/default.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
            </div>
            
            <!--Image, and Author Info -->
            <div class="w-full lg:w-1/3 px-2 mb-4">
                <div>
                    <!-- Image and author info -->
                    <div class="p-4 rounded shadow-lg" style="background-color: #333">
                        <div class="mb-4">
                            <img src="{{ asset('images/' . $guide->firstImage->path) }}" alt="" class="game-image w-full object-cover rounded">
                        </div>
                        <p class=" text-lg text-white font-bold mb-1">Game: {{ $guide->game->name }}</p>
                        <p class="text-lg text-gray-200 font-semibold mb-1">Reviewed by: {{ $guide->user->name }}</p>
                        <p class=" text-lg text-gray-200 font-semibold">Published on: {{ $guide->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Text -->
        <div class=" p-4 rounded shadow-lg mt-6 guide-content">
            {!! $guide->content !!}
        </div>

        <!-- Back Button -->
        <div class="text-center my-6">
            <a href="{{ route('guides.index') }}" class="inline-block px-10 py-4 leading-none text-xl text-white transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Back</a>
        </div>
    </div>
</div>
@endsection
