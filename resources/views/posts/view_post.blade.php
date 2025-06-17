<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Blog - Post Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .post-card {
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 2rem;
        }

        .post-title {
            font-size: 2rem;
            font-weight: 600;
        }

        .post-meta {
            font-size: 0.95rem;
            color: #6c757d;
        }

        .post-content {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-top: 1.5rem;
        }

        .meta-label {
            font-weight: 500;
        }

        .comment-section {
            border-top: 1px solid #dee2e6;
            padding-top: 2rem;
        }

        .comment-list .comment {
            border-left: 4px solid #0d6efd;
            background-color: #f8f9fa;
        }

        .comment .fw-semibold {
            color: #0d6efd;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <a href="{{ route('posts.index') }}" class="btn btn-success mb-4 p-2">Home</a>
            <span class="me-3 fw-bold text-dark">Welcome, {{ Auth::user()->name }}!</span>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li>
                        <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('password.change') }}">Change Password</a>
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>

                </ul>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($post)
        <div class="post-card bg-white">
            <h1 class="post-title">{{ $post->title }}</h1>



            <div class="post-meta mb-4">
                <div><span class="meta-label">Author:</span> {{ $post->author->name  }}</div>
                <div><span class="meta-label">Category:</span> {{ $post->category }}</div>
                <div><span class="meta-label">Created at:</span> {{ $post->created_at->format('F j, Y, g:i a') }}</div>
                <div><span class="meta-label">Last updated:</span> {{ $post->updated_at->format('F j, Y, g:i a') }}</div>
            </div>

            <div class="post-content">
                {!! nl2br(e($post->content)) !!}
            </div>

            @if ($post->author_id === Auth::id())
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit Post</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                </form>
            </div>
            @endif

            <!-- Comment Section -->
            <div class="comment-section mt-5">
                <h4 class="mb-4">Leave a Comment</h4>

                <form action="{{ route('comments.store') }}" method="POST" class="mb-5">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="hidden" name="parent_id" value="{{ null }}">
                    <div class="mb-3">
                        <textarea class="form-control" id="comment_content" name="content" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Comment</button>
                </form>

                <!-- Comments -->
                @if ($post->comments->isNotEmpty())
                @foreach ($post->comments as $comment)
                <div class="comment-list mb-3">
                    <div class="comment p-3 rounded">
                        <div class="fw-semibold mb-1">{{ $comment->commenter_name }}</div>
                        <div>{!! nl2br(e($comment->content)) !!}</div>
                        <div>
                            <span class="text-muted small font-monospace">
                                {{ $comment->created_at->format('F j, Y, g:i a') }}
                            </span>
                        </div>

                        <!-- Reply Form -->
                        <form action="{{ route('comments.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <div class="mb-2 ms-2">
                                <textarea class="form-control" name="content" rows="2" placeholder="Write a reply..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Reply</button>
                        </form>

                        {{-- <!-- Replies -->--}}
                        @include('posts.partials.replies', ['replies' => $comment->replies, 'postId' => $post->id])
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-muted">No comments yet.</div>
                @endif
            </div>
        </div>
        @else
        <div class="alert alert-danger">Post not found.</div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>