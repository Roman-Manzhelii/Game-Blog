@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-4xl font-semibold mb-6 text-center">Game Guides</h1>

    @auth
        <div class="mb-6 text-right">
            <a href="{{ route('guides.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Add New Guide
            </a>
        </div>
    @endauth
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($guides as $guide)
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
            @if ($guide->path_image)
            <img class="w-full" src="{{ asset('storage/'.$guide->path_image) }}" alt="Guide Image">
            @endif
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $guide->title }}</div>
                <p class="text-gray-700 text-base">
                    {{ Str::limit($guide->description, 100) }}
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <a href="{{ route('guides.show', $guide->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Read More
                </a>
            </div>
        </div>
        @endforeach
    </div>
    {{ $guides->links() }}
</div>
@endsection

