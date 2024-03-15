@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 bg-gray-300 min-h-screen">
    <h1 class="text-5xl font-bold italic tracking-wide text-center text-gray-800 mb-8">Guides</h1>
    
    @auth
            <div class="mb-6 text-right">
                <a href="{{ route('guides.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Guide</a>
            </div>
    @endauth

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($guides as $guide)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-lg flex flex-col justify-between h-full bg-gray-100">
                @if($guide->firstImage)
                    <img src="{{ asset('images/' . $guide->firstImage->path) }}" alt="" class="w-full h-72 object-cover rounded-lg">
                @endif
                <div class="px-6 py-4 flex-grow">
                    <div class="font-bold text-xl mb-2">{{ $guide->title }}</div>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <a href="{{ route('guides.show', $guide->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Read More
                    </a>
                </div>
                @auth
                    @if (auth()->user()->id === $guide->user_id)
                    <div class="px-6 py-2 flex justify-center items-end">
                        <a href="{{ route('guides.edit', $guide->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Edit</a>
                        <form action="{{ route('guides.destroy', $guide->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this guide?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
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
