@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $guide->title }}</h1>
    <p>Game: {{ $guide->game->name }}</p>
    <div>{!! $guide->content !!}</div>
    @if($guide->image_path)
    <img src="{{ asset('storage/'.$guide->image_path) }}" alt="Guide Image" style="max-width:100%;">
    @endif
    <p>Published on: {{ $guide->created_at->toFormattedDateString() }}</p>
</div>
@endsection
