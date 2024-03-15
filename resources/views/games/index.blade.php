@extends('layouts.app')

@section('content')
<div class="w-full min-h-screen bg-gray-300">
    <div class="px-4">
    <h1 class="text-5xl font-bold italic tracking-wide text-center text-gray-800 mb-8">Games</h1>

    @if(Session::has('error'))
        <script>
            window.onload = function() {
                alert('{{ Session::get('error') }}');
            };
        </script>
    @endif
    

    @auth
        @can('manage-games', Auth::user())
            <div class="mb-6 text-right">
                <a href="{{ route('games.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Game</a>
            </div>
        @endcan
    @endauth

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($games as $game)
            <div class="max-w-sm rounded-lg overflow-hidden shadow-lg flex flex-col justify-between h-full bg-gray-100">
                @if ($game->image_path)
                    <img src="{{ asset('images/' . $game->image_path) }}" alt="" class="w-full h-96 object-cover rounded-lg">
                @endif
                <div class="px-6 py-4 flex-grow">
                    <div class="font-bold text-xl mb-2">{{ $game->name }}</div>
                    <p class="text-gray-700 text-base">
                        {{ Str::limit($game->description, 150) }}
                    </p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <a href="{{ route('games.show', $game->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Read More
                    </a>
                </div>
                @can('manage-games', Auth::user())
                    <div class="px-6 py-2 flex justify-center items-end">
                        <a href="{{ route('games.edit', $game->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mr-2">Edit</a>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this game?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Delete</button>
                        </form>
                    </div>
                @endcan
            </div>
        @empty
        @endforelse
    </div>  
</div>  
</div>

@endsection
