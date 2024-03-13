@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-6">Edit Gam: {{ $game->name }}</h1>
    <form action="{{ route('games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-2xl bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $game->name }}" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $game->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="developer" class="form-label">Developer</label>
            <input type="text" class="form-control" id="developer" name="developer" value="{{ $game->developer }}">
        </div>
        <div class="mb-3">
            <label for="release_date" class="form-label">Release Date</label>
            <input type="date" class="form-control" id="release_date" name="release_date" value="{{ $game->release_date ? $game->release_date->format('Y-m-d') : '' }}">
        </div>      
        <div class="mb-3">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" value="{{ $game->genre }}">
        </div>
        <div class="mb-3">
            <label for="platform" class="form-label">Platform</label>
            <input type="text" class="form-control" id="platform" name="platform" value="{{ $game->platform }}">
        </div>
        <div class="mb-5">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-700">Game Image</label>
            @if($game->image_path)
                <div class="mb-4">
                    <img src="{{ asset('images/' . $game->image_path) }}" alt="" class="w-full object-cover rounded">
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>
        <div class="mb-5">
            <label for="video" class="block mb-2 text-sm font-medium text-gray-700">Game Video</label>
            @if($game->video_path)
                <video width="320" height="240" controls>
                    <source src="{{ asset('videos/' . $game->video_path) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
            <input type="file" id="video" name="video" accept="video/*" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>

        <div class="mt-4 flex justify-between">
            <a href="{{ route('games.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Cancel</a>
            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Game</button>
        </div>
    </form>
</div>
@endsection
