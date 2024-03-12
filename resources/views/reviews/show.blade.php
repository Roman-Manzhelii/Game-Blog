@extends('layouts.app')

@section('content')
<div class="bg-gray-300 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-5xl font-bold italic uppercase tracking-wide text-center text-gray-800 mb-8">{{ $review->title }}</h1>
        
        <div class="flex flex-wrap -mx-2">
            <!-- Video or Placeholder Container -->
            <div class="w-full lg:w-2/3 px-2 mb-4">
                @if($review->video_path)
                    <div class="rounded overflow-hidden shadow-lg bg-white">
                        <video width="100%" height="auto" controls>
                            @php
                                $videoType = 'video/' . pathinfo($review->video_path, PATHINFO_EXTENSION);
                            @endphp
                            <source src="{{ asset('videos/' . $review->video_path) }}" type="{{ $videoType }}">
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
            
            <!-- Sidebar Container for Rating, Image, and Author Info -->
            <div class="w-full lg:w-1/3 px-2 mb-4">
                <div class="sticky top-8">
                    <!-- Rating Block -->
                    @php
                        $ratingValue = $review->rating; // Assuming $review->rating is now between 1 and 100
                        $ratingColor = 'bg-green-500'; // Default color
                        if ($ratingValue <= 10) {
                            $ratingColor = 'bg-red-500';
                        } elseif ($ratingValue <= 20) {
                            $ratingColor = 'bg-red-400';
                        } elseif ($ratingValue <= 30) {
                            $ratingColor = 'bg-orange-400';
                        } elseif ($ratingValue <= 40) {
                            $ratingColor = 'bg-yellow-500';
                        } elseif ($ratingValue <= 50) {
                            $ratingColor = 'bg-yellow-400';
                        } elseif ($ratingValue <= 60) {
                            $ratingColor = 'bg-green-400';
                        } elseif ($ratingValue <= 70) {
                            $ratingColor = 'bg-teal-400';
                        } elseif ($ratingValue <= 80) {
                            $ratingColor = 'bg-blue-500';
                        } elseif ($ratingValue <= 90) {
                            $ratingColor = 'bg-indigo-500';
                        } elseif ($ratingValue <= 100) {
                            $ratingColor = 'bg-purple-500';
                        }
                    @endphp
                    <span class="block {{ $ratingColor }} mb-4 p-4 rounded shadow-lg flex justify-center items-center text-white font-bold py-2 px-4 rounded-lg text-6xl w-28 h-28">
                        {{ $review->rating }}
                    </span>
                
                    <!-- Image and author info -->
                    <div class="bg-white p-4 rounded shadow-lg">
                        <div class="mb-4">
                            <img src="{{ asset('images/' . $review->image_path) }}" alt="Game image" class="w-full object-cover rounded">
                        </div>
                        <p class="text-gray-800 font-semibold">Reviewed by: {{ $review->user->name }}</p>
                        <p class="text-sm text-gray-600">Published on: {{ $review->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Text -->
        <div class="bg-white p-4 rounded shadow-lg mt-6">
            <p class="text-gray-700 whitespace-pre-line">{{ $review->content }}</p>
        </div>
                
        <!-- Back Button -->
        <div class="text-center mt-6">
            <a href="{{ route('reviews.index') }}" class="inline-block px-10 py-4 leading-none text-xl text-white transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Back</a>
        </div>        
    </div>
</div>
@endsection



