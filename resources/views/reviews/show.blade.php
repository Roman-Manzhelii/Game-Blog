
@extends('layouts.app')

@section('content')
<div class="bg-gray-300 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-5xl font-bold italic uppercase tracking-wide text-center text-gray-800 mb-8">{{ $review->title }}</h1>


        <div class="flex flex-wrap -mx-2">
            <!-- Video or Placeholder Container -->
            <div class="w-full lg:w-2/3 px-2 mb-4">
                @if($review->video_path)
                    <div class="rounded overflow-hidden shadow-lg bg-white">
                        <video width="100%" height="auto" controls>
                            @php
                                $videoType = 'video/' . pathinfo($review->video_path, PATHINFO_EXTENSION);
                            @endphp
                            <source src="{{ asset('videos/' . $review->video_path) }}" type="{{ $videoType }}">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @else
                    <div class="rounded overflow-hidden shadow-lg bg-white">
                        <video width="100%" height="auto" controls>
                            <source src="{{ asset('videos/default.mp4') }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
                
            </div>
            
            <!-- Sidebar Container for Rating, Image, and Author Info -->
            <div class="w-full lg:w-1/3 px-2 mb-4">
                <div class="sticky top-8">
                    <!-- Rating Block -->
                    @php
                        $ratingValue = $review->rating; // Assuming $review->rating is now between 1 and 100
                        $ratingColor = 'bg-green-500'; // Default color
                        if ($ratingValue <= 10) {
                            $ratingColor = 'bg-red-500';
                        } elseif ($ratingValue <= 20) {
                            $ratingColor = 'bg-red-400';
                        } elseif ($ratingValue <= 30) {
                            $ratingColor = 'bg-orange-400';
                        } elseif ($ratingValue <= 40) {
                            $ratingColor = 'bg-yellow-500';
                        } elseif ($ratingValue <= 50) {
                            $ratingColor = 'bg-yellow-400';
                        } elseif ($ratingValue <= 60) {
                            $ratingColor = 'bg-green-400';
                        } elseif ($ratingValue <= 70) {
                            $ratingColor = 'bg-teal-400';
                        } elseif ($ratingValue <= 80) {
                            $ratingColor = 'bg-blue-500';
                        } elseif ($ratingValue <= 90) {
                            $ratingColor = 'bg-indigo-500';
                        } elseif ($ratingValue <= 100) {
                            $ratingColor = 'bg-purple-500';
                        }
                    @endphp
                    <span class="block {{ $ratingColor }} mb-4 p-4 rounded shadow-lg flex justify-center items-center text-white font-bold py-2 px-4 rounded-lg text-6xl w-28 h-28">
                        {{ $review->rating }}
                    </span>
                
                    <!-- Image and author info -->
                    <div class="bg-white p-4 rounded shadow-lg">
                        <div class="mb-4">
                            <img src="{{ asset('images/' . $review->image_path) }}" alt="Game image" class="w-full object-cover rounded">
                        </div>
                        <p class="text-gray-800 font-semibold">Reviewed by: {{ $review->user->name }}</p>
                        <p class="text-sm text-gray-600">Published on: {{ $review->created_at->toFormattedDateString() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Review Text -->
        <div class="bg-white p-4 rounded shadow-lg mt-6">
            <p class="text-gray-700 whitespace-pre-line">{{ $review->content }}</p>
        </div>

        <!-- Back Button -->
        <div class="text-center my-6">
            <a href="{{ route('reviews.index') }}" class="inline-block px-10 py-4 leading-none text-xl text-white transition-colors duration-200 transform bg-blue-600 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Back</a>
        </div>

    {{-- Comments section --}}
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Comments</h2>

        @auth
            {{-- Comment submission form --}}
            <form method="POST" action="{{ route('comments.store', $review->id) }}">
                @csrf
                <div class="mb-2">
                    <textarea name="body" rows="3" class="w-full p-2 rounded" placeholder="Leave a comment..." required></textarea>
                </div>
                <div class="mb-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Comment</button>
                </div>
            </form>
        @endauth

        </br></br>
        @foreach ($review->comments as $comment)
        <div class="bg-white p-4 rounded shadow-lg my-4" id="comment-{{ $comment->id }}">
            <div class="mb-2">
                <strong>{{ $comment->user->name }}</strong> - <span class="text-gray-600">{{ $comment->updated_at->diffForHumans() }}</span>
            </div>
    
            <div class="comment-body">
                {{ Str::limit($comment->body, 300, '...') }}
                @if (strlen($comment->body) > 300)
                    <span class="more-text hidden">{{ substr($comment->body, 300) }}</span>
                    <a href="javascript:void(0);" class="read-more-btn text-blue-600 hover:text-blue-800 cursor-pointer" onclick="toggleReadMore(this)">Read more</a>
                @endif
            </div>
    
            @if (auth()->check() && auth()->user()->id == $comment->user_id)
                <button onclick="editComment({{ $comment->id }})" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Edit</button>
            @endif
    
            <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="edit-comment-form hidden">
                @csrf
                @method('PUT')
                <textarea name="body" rows="2" class="comment-edit-body form-input mt-1 block w-full">{{ $comment->body }}</textarea>
                <button type="submit" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Save</button>
                <button type="button" onclick="cancelEdit({{ $comment->id }})" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Cancel</button>
            </form>

            <button onclick="showReplyForm({{ $comment->id }})">Reply</button>

            <!-- Форма для відповіді (прихована за замовчуванням) -->
            <div id="reply-form-{{ $comment->id }}" style="display: none;">
                <form method="POST" action="{{ route('comments.store', $review->id) }}">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <textarea name="body" placeholder="Your reply..."></textarea>
                    <button type="submit">Submit Reply</button>
                </form>
            </div>
    
            <!-- Відображення відповідей -->
            @foreach ($comment->replies as $reply)
                <div class="reply">
                    <!-- Вміст відповіді -->
                </div>
            @endforeach
        </div>
    @endforeach

  
    </div>
</div>

<script>
function editComment(commentId) {
    const commentDiv = document.getElementById(`comment-${commentId}`);
    commentDiv.querySelector('.comment-body').classList.add('hidden');
    commentDiv.querySelector('.edit-comment-form').classList.remove('hidden');
}

function cancelEdit(commentId) {
    const commentDiv = document.getElementById(`comment-${commentId}`);
    commentDiv.querySelector('.comment-body').classList.remove('hidden');
    commentDiv.querySelector('.edit-comment-form').classList.add('hidden');
}

function toggleReadMore(btn) {
    var moreText = btn.previousElementSibling;
    var btnText = btn;

    if (btnText.textContent === "Read more") {
        btnText.textContent = "Read less";
        moreText.classList.remove('hidden');
    } else {
        btnText.textContent = "Read more";
        moreText.classList.add('hidden');
    }
}

function showReplyForm(commentId) {
    var form = document.getElementById('reply-form-' + commentId);
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

</script>
@endsection
