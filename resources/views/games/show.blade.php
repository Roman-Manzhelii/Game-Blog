@extends('layouts.app')

@section('content') 
<style>
    .game-image {
        max-height: 500px;
    }

</style>

<div class="bg-gray-300 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-5xl font-bold italic uppercase tracking-wide text-center text-gray-800 mb-8">{{ $game->name }}</h1>

        <div class="flex flex-wrap -mx-2">
            <!-- Video or Placeholder Container -->
            <div class="w-full lg:w-2/3 px-2 mb-4">
                @if($game->video_path)
                    <div class="rounded overflow-hidden shadow-lg bg-white">
                        <video width="100%" height="auto" controls>
                            @php
                                $videoType = 'video/' . pathinfo($game->video_path, PATHINFO_EXTENSION);
                            @endphp
                            <source src="{{ asset('videos/' . $game->video_path) }}" type="{{ $videoType }}">
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

                <div class="bg-white mt-2 p-3 rounded shadow-lg">
                    <p class="text-gray-600 font-semibold py-1"><strong>Developer:</strong> {{ $game->developer }}</p>
                    <p class="text-gray-600 font-semibold py-1"><strong>Genre:</strong> {{ $game->genre }}</p>
                    <p class="text-gray-600 font-semibold py-1"><strong>Platform:</strong> {{ implode(' | ', json_decode($game->platform, true)) }}</p>
                    <p class="text-gray-600 font-semibold py-1"><strong>Release:</strong> {{ \Carbon\Carbon::parse($game->release_date)->format('j F, Y') }}</p>
                </div>
                
            </div>
            
            
            <!-- Sidebar for Image, and Author Info -->
            <div class="w-full lg:w-1/3 px-2 mb-4">
                <div>            
                    <!-- Image and author info -->
                    <div class="bg-white p-4 rounded shadow-lg">
                        <div class="mb-4">
                            <img src="{{ asset('images/' . $game->image_path) }}" alt="" class="game-image w-full object-cover rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Text -->
        <div class="bg-white p-4 rounded shadow-lg mt-6">
            <p class="text-gray-700 whitespace-pre-line">{{ $game->description }}</p>
        </div>

        <!-- Back Button -->
        <div class="text-center my-6">
            <a href="{{ route('games.index') }}" class="inline-block px-10 py-4 leading-none text-xl text-white transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Back</a>
        </div>
    </div>
</div>
@endsection
