<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-card {
            max-width: 600px;
            margin: 3rem auto;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
            padding: 2rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="profile-card">
        <h2 class="mb-4 text-center"> My Profile</h2>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Name:</strong> {{ $user->name }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
            <li class="list-group-item"><strong>Registered On:</strong> {{ $user->created_at->format('F j, Y') }}</li>
        </ul>
        <div class="mt-4 text-center">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">← Back to Blog</a>
        </div>
    </div>
</div>
</body>
</html>
