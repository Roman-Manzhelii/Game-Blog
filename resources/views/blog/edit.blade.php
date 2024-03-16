@extends('layouts.app')

@section('content')
<div style="background-color: #131313">
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl text-white">
                Update Post
            </h1>
        </div>
    </div>

    @if ($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-200 bg-red-500 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-4/5 m-auto pt-20 text-gray-300">
        <form 
            action="/blog/{{ $post->slug }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input 
                type="text"
                name="title"
                value="{{ $post->title }}"
                class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

            <textarea 
                name="description"
                placeholder="Description..."
                class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">{{ $post->description }}</textarea> 

            <div class="bg-grey-lighter pt-15 mb-15">
                <label class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer">
                    <span class="mt-2 text-base leading-normal">
                        Select a file
                    </span>
                    <input 
                        type="file"
                        name="image"
                        class="hidden">
                </label>
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('blog.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-white">Cancel</a>
                <button type="submit" class="uppercase bg-blue-500 text-gray-200 text-lg font-extrabold py-4 px-8 rounded-3xl"> Submit Post </button>
            </div>
        </form>
    </div>
</div>
@endsection