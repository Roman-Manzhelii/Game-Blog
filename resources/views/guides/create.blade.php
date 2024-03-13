@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Guide</h1>
    <form method="POST" action="{{ route('guides.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="game_id">Game:</label>
            <select name="game_id" id="game_id" class="form-control">
                @foreach($games as $game)
                <option value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="content">Guide Content:</label>
            <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="image">Guide Image:</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
