<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa, #e0eafc);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .blog-header {
            text-align: center;
            padding: 40px 0;
            color: #343a40;
        }

        .card {
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #6c757d;
            color: white;
        }

        .card-body p {
            color: #495057;
        }

        .meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .single-post {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between">
            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-4 p-2">➕ Create New Post</a>



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

        <div class="blog-header">
            <h1 class="display-5 fw-bold">📝 My Blog</h1>
        </div>

        @forelse($posts as $post)
        <div class="card mb-4">
            <a class="single-post" href="{{ route('posts.show', $post->id) }}">
                <div class="card-header">
                    <h4 class="mb-0">{{ $post->title }}</h4>
                </div>
                <div class="card-body">
                    <p>{{ \Illuminate\Support\Str::words($post->content, 21, '...') }}</p>
                    <hr>
                    <div class="meta">
                        <span>👤 Author: {{ $post->author->name  }}</span>|
                        <span>💻 Category: {{ $post->category }}</span> |
                        <span>🕒 {{ $post->created_at->format('F j, Y, g:i a') }}</span>
                    </div>
                </div>
            </a>
        </div>
        @empty
        <p>No posts found.</p>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>