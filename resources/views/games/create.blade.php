@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-8 text-center">Add New Game</h1>
    <div class="w-full max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">Name</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="description">Description</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="developer">Developer</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="developer" name="developer" rows="4" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="release_date">Release Date</label>
                <input type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="release_date" name="release_date" required>
            </div>      
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="genre">Genre</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="genre" name="genre" rows="4" required></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="platform">Platform</label>
                <select id="platform" name="platform[]" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" multiple required>
                    <option value="PC">PC</option>
                    <option value="Xbox">Xbox</option>
                    <option value="PlayStation">PlayStation</option>
                    <option value="Switch">Switch</option>
                    <option value="Mobile">Mobile</option>
                    <!-- Інші платформи за потребою -->
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="image">Game Image</label>
                <input type="file" id="image" name="image" accept="image/*" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="video">Game Video (optional):</label>
                <input type="file" id="video" name="video" accept="video/*" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('games.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Cancel</a>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Add Game
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
