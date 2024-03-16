@extends('layouts.app')

@section('content')
<style>
    .game-image {
        max-height: 800px;
    }

</style>

<div class="mx-auto px-4 py-8" style="background-color: #131313">
    <h1 class="text-3xl font-semibold mb-8 text-center text-white">Edit Game: {{ $game->name }}</h1>
    <div class="w-full max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md" style="background-color: #333">
    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-2xl p-6">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block mb-2 font-bold text-gray-200">Name</label>
            <input type="text" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200  border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" id="name" name="name" value="{{ $game->name }}" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block mb-2 font-bold text-gray-200">Description</label>
            <textarea style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" id="description" name="description" rows="4" required>{{ $game->description }}</textarea>
        </div>
        <div class="mb-4">
            <label for="developer" class="block mb-2 font-bold text-gray-200">Developer</label>
            <input type="text" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" id="developer" name="developer" value="{{ $game->developer }}" required>
        </div>
        <div class="mb-4">
            <label for="release_date" class="block mb-2 font-bold text-gray-200">Release Date</label>
            <input type="date" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" id="release_date" name="release_date" value="{{ \Carbon\Carbon::parse($game->release_date)->format('Y-m-d') }}" required>
        </div>      
        <div class="mb-4">
            <label for="genre" class="block mb-2 font-bold text-gray-200">Genre</label>
            <input type="text" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" id="genre" name="genre" value="{{ $game->genre }}" required>
        </div>
        <div class="mb-4">
            <label for="platform" class="block text-gray-200 font-bold mb-2">Platform</label>
            <select id="platform" name="platform[]" style="background-color: #333" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:shadow-outline" multiple required>
                @php
                $selectedPlatforms = json_decode($game->platform);
                @endphp
                <option value="PC" @if(in_array('PC', $selectedPlatforms)) selected @endif>PC</option>
                <option value="Xbox" @if(in_array('Xbox', $selectedPlatforms)) selected @endif>Xbox</option>
                <option value="PlayStation" @if(in_array('PlayStation', $selectedPlatforms)) selected @endif>PlayStation</option>
                <option value="Switch" @if(in_array('Switch', $selectedPlatforms)) selected @endif>Switch</option>
                <option value="Mobile" @if(in_array('Mobile', $selectedPlatforms)) selected @endif>Mobile</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label for="image" class="block mb-2 font-bold text-gray-200">Game Image</label>
            @if($game->image_path)
                <div class="mb-4">
                    <img src="{{ asset('images/' . $game->image_path) }}" alt="" class="game-image w-full object-cover rounded">
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>
        <div class="mb-4">
            <label for="video" class="block mb-2 font-bold text-gray-200">Game Video (optional):</label>
            @if($game->video_path)
                <video width="100%" height="auto" controls class="w-full object-cover rounded">
                    <source src="{{ asset('videos/' . $game->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
            <input type="file" id="video" name="video" accept="video/*" style="background-color: #333" class="block w-full px-4 py-2 text-gray-200 border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>

        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('games.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Cancel</a>
            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Game</button>
        </div>
    </form>
    </div>
</div>
@endsection
