@extends('layouts.app')

@section('content') 

<style>
    .ellipsis-btn {
    position: absolute;
    top: 2px;
    right: 0;
    padding: 10px; 
    z-index: 101; 
    }

    .menu-hidden button {
    display: block;
    width: 100%;
    }

    .ellipsis-btn, .menu-hidden button {
        background: none;
        border: none;
        cursor: pointer;
        outline: none;
    }

    .ellipsis-btn:focus, .menu-visible button:focus {
        outline: none;
        box-shadow: none;
    }

    .menu-hidden {
        display: none;

        }

    .menu-visible {
        display: block;
        position: absolute;
        right: 30px;
        top: 0;
        z-index: 100;
        padding: 5px;
        width: auto;
    }

    .deleted-comment {
    color: #747474;
    font-style: italic;
    }

    .game-image {
        max-height: 500px;
    }

</style>

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
            
            
            <!-- Sidebar for Rating, Image, and Author Info -->
            <div class="w-full lg:w-1/3 px-2 mb-4">
                <div>
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
                            <img src="{{ asset('images/' . $review->image_path) }}" alt="" class="game-image w-full object-cover rounded">
                        </div>
                        <p class="text-gray-800 font-semibold mb-1">Reviewed by: {{ $review->user->name }}</p>
                        <p class="text-gray-800 font-semibold">Published on: {{ $review->created_at->toFormattedDateString() }}</p>
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

        {{-- Comments Section --}}
        <div class="mt-6">
            <h2 class="text-xl font-semibold mb-4">Comments</h2>

            @auth
            {{-- Comment Submission Form --}}
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
            @foreach ($review->comments->whereNull('parent_id') as $comment)
            <div class="bg-white p-4 rounded-lg shadow-lg my-4 relative" id="comment-{{ $comment->id }}">
                <div class="mb-2">
                    <strong>{{ $comment->user->name }}</strong> - <span class="text-gray-600">{{ $comment->updated_at->diffForHumans() }}</span>
                </div>

                <div id="edit-form-{{ $comment->id }}" class="edit-comment-form hidden">
                    <form method="POST" action="{{ route('comments.update', $comment->id) }}">
                        @csrf
                        @method('PUT')
                        <textarea name="body" rows="8" class="w-full p-3 rounded border">{{ $comment->body }}</textarea>
                        <button type="submit" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-green">Update</button>
                        <button type="button" onclick="cancelEdit({{ $comment->id }})" class="mt-2 inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Cancel</button>
                    </form>
                </div>

                <div class="comment-body break-words" id="comment-text-{{ $comment->id }}">
                    @if($comment->is_deleted)
                        <div class="deleted-comment">
                            deleted comment
                        </div>
                    @else
                        <div>
                            {{ $comment->body }}
                        </div>
                    @endif
                
                </div>

                @if (auth()->check() && auth()->user()->id == $comment->user_id)
                    <div class="absolute top-0 right-0 p-2 ">
                        <button class="ellipsis-btn" onclick="toggleMenu({{ $comment->id }})">︙</button>
                        <div class="menu-hidden" id="menu-{{ $comment->id }}">
                            <button onclick="editComment({{ $comment->id }})" class="text-sm text-blue-500">Edit</button>
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this review?')" class="text-sm text-red-500">Delete</button>
                            </form>                            
                        </div>
                    </div>
                @endif

                {{-- Show replies button --}}
                <div class="flex justify-between items-center mt-2">
                    @if($comment->replies->count() > 0)
                    <button onclick="toggleReplies({{ $comment->id }})" class="text-sm text-blue-500 hover:text-blue-800 focus:outline-none focus:ring-0">View {{ $comment->replies->count() }} replies</button>
                    @endif
                
                    @if (auth()->check() && auth()->user()->id != $comment->user_id)
                        <button class="reply-btn mt-2 text-sm text-white bg-blue-500 hover:bg-blue-600 font-medium py-2 px-4 rounded transition duration-300" onclick="showReplyForm(event, {{ $comment->id }})">Reply</button>
                    @endif
                </div>

                <!-- Форма для відповіді (прихована за замовчуванням) -->
                <div id="reply-form-{{ $comment->id }}" class="hidden mt-2">
                    <form method="POST" action="{{ route('comments.store', $review->id) }}">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <textarea name="body" rows="2" class="w-full p-3 rounded border" placeholder="Write a reply..." class="w-full p-2 rounded"></textarea>
                        <button type="submit" class="text-sm bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-1">Submit Reply</button>
                    </form>
                </div>
            
                <div id="replies-{{ $comment->id }}" class="replies-container hidden ml-4 mt-2">
                    @foreach ($comment->replies as $reply)
                    <div class="border reply bg-gray-200 p-3 rounded my-2">
                        <strong>{{ $reply->user->name }} </strong> - <span class="text-gray-600">{{ $reply->updated_at->diffForHumans() }}</span>
                        <p>{{ $reply->body }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
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

    function showReplyForm(event, commentId) {
    event.preventDefault();
    var form = document.getElementById('reply-form-' + commentId);
        if(form) {
            form.classList.toggle('hidden');
        }
    }
    
    function toggleReplies(commentId) {
        var repliesDiv = document.getElementById('replies-' + commentId);
        repliesDiv.classList.toggle('hidden');
    }

    function toggleMenu(commentId) {
    var menu = document.getElementById('menu-' + commentId);
    if (menu.classList.contains('menu-hidden')) {
        menu.classList.remove('menu-hidden');
        menu.classList.add('menu-visible');
    } else {
        menu.classList.remove('menu-visible');
        menu.classList.add('menu-hidden');
    }
}

    </script>
@endsection
