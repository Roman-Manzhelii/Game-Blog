@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-8 text-center">Create New Guide</h1>
    <div class="w-full max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('guides.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" name="title" required>
            </div>
            
            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-bold mb-2">Content</label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="content" name="content" rows="6" required></textarea>
            </div>
            
            <div class="mb-4">
                <label for="game_id" class="block text-gray-700 font-bold mb-2">Select Game</label>
                <select id="game_id" name="game_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    @foreach ($games as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Guide Image</label>
                <input type="file" id="image" name="images[]" accept="image/*" multiple class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="video" class="block text-gray-700 font-bold mb-2">Guide Video (optional):</label>
                <input type="file" id="video" name="videos[]" accept="video/*" multiple class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mt-4 flex items-center justify-between">
                <a href="{{ route('guides.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Cancel</a>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Create Guide
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.tiny.cloud/1/vufhsbpswonckewjcb0pt09lklxu66q8w27glg5nqki9tv6t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#content'
  });
</script>
@endsection
