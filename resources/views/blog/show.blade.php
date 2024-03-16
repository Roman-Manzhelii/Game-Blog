@extends('layouts.app')

@section('content')
<div style="background-color: #131313">
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl text-white">
                {{ $post->title }}
            </h1>
        </div>
    </div>

    <div class="w-4/5 m-auto pt-20">
        <span class="text-gray-400">
            By <span class="font-bold italic text-gray-300">{{ $post->user->name }}</span>, Created on {{ date('jS M Y', strtotime($post->updated_at)) }}
        </span>

        <p class="text-xl text-gray-300 pt-8 pb-10 leading-8 font-light">
            {{ $post->description }}
        </p>
    </div>

    <div class="text-center">
        <a href="{{ route('blog.index') }}" class="inline-block px-10 py-4 leading-none text-xl text-white transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Back</a>
    </div>
</div>
@endsection 