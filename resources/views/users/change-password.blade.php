<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
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
        <h3 class="mb-4 text-center text-primary">🔒 Change Password</h3>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Change Password Form --}}
        <form action="{{ route('password.update') }}" method="POST">
            @csrf

            {{-- Current Password --}}
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password"
                       class="form-control rounded-pill @error('current_password') is-invalid @enderror" required>
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- New Password --}}
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" id="new_password" name="new_password"
                       class="form-control rounded-pill @error('new_password') is-invalid @enderror" required>
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm New Password --}}
            <div class="mb-4">
                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                       class="form-control rounded-pill" required>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary rounded-pill">Update Password</button>
            </div>
        </form>

        <div class="text-center">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">← Back to Blog</a>
        </div>
    </div>
</div>
</body>
</html>
