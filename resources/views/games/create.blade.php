@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-8 text-center">Add New Game</h1>
    <div class="w-full max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="developer">Developer</label>
                <textarea class="form-control" id="developer" name="developer" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="release_date">Release Date</label>
                <input type="date" class="form-control" id="release_date" name="release_date">
            </div>      
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="genre">Genre</label>
                <textarea class="form-control" id="genre" name="genre" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="platform">Platform</label>
                <textarea class="form-control" id="platform" name="platform" rows="3"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Game Image</label>
                <input type="file" id="image" name="image" accept="image/*" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="video">Game Video</label>
                <input type="file" id="video" name="video" accept="video/*" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <button type="submit" class="btn btn-primary">Add Game</button>
        </form>
    </div>
</div>
@endsection
