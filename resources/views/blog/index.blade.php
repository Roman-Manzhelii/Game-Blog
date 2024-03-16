@extends('layouts.app')

@section('content')
<div style="background-color: #131313">
    <div class="w-4/5 m-auto text-center" >
        <div class="py-15 border-b" >
            <h1 class="text-6xl text-white">
            MY Blog Posts
            </h1>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="w-full m-auto mt-10 pl-2">
            <p class="mb-4 text-black bg-blue-300 rounded-lg py-4 px-6 text-lg">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif


    @if (Auth::check())
        <div class="py-10 w-4/5 m-auto ">
            <a 
                href="/blog/create"
                class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                Create post
            </a>
        </div>
    @endif

    @foreach ($posts as $post)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
                <div class="flex justify-center">
                    <img src="{{ asset('images/' . $post->image_path) }}" alt="" class="w-auto h-96 object-cover rounded-lg">
                </div>
                <div style="background-color: #333" class="rounded-lg p-5 overflow-hidden">
                    <h2 class="text-gray-200 font-bold text-5xl pb-4 overflow-hidden">
                        {{ $post->title }}
                    </h2>

                    <span class="text-gray-300">
                        By <span class="font-bold italic text-gray-200">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
                    </span>
                    <div class="flex-grow">
                        <p class="text-gray-300 pt-8 pb-10 overflow-ellipsis overflow-hidden">
                            {{ Str::limit($post->description, 50) }}
                        </p>
                    </div>
                    

                    <a href="/blog/{{ $post->slug }}" class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                        Keep Reading
                    </a>

                    @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                        <span class="float-right">
                            <a 
                                href="/blog/{{ $post->slug }}/edit"
                                class="text-blue-500 italic hover:text-blue-400 pb-1">
                                Edit
                            </a>
                        </span>

                        <span class="float-right">
                            <form 
                                action="/blog/{{ $post->slug }}"
                                method="POST">
                                @csrf
                                @method('delete')

                                <button
                                    class="text-red-500 hover:text-red-400 pr-3"
                                    type="submit">
                                    Delete
                                </button>
                            </form>
                        </span>
                    @endif
                </div>
        </div>    
    @endforeach
</div>
@endsection