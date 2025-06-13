<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/295/295128.png">
    <title>Login</title>
</head>
<body class="bg-light">
<div class="container p-5 d-flex flex-column align-items-center">
    @if (session('success'))
        <div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: green;">
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast align-items-center text-white border-0" role="alert" aria-live="assertive" aria-atomic="true" style="background-color: red;">
            <div class="d-flex">
                <div class="toast-body">{{ session('error') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="form-control mt-5 p-4" style="height: auto; width:380px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
        @csrf
        <div class="row">
            <i class="fa fa-user-circle-o fa-3x mt-1 mb-2" style="text-align: center; color: green;"></i>
            <h5 class="text-center p-4" style="font-weight: 700;">Login Into Your Account</h5>
        </div>

        <div class="col-mb-3">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="col mb-3 mt-3">
            <label for="password"><i class="fa fa-lock"></i> Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="col mb-3 mt-3">
            <button type="submit" class="btn btn-success bg-success" style="font-weight: 600;">Login</button>
        </div>

        <div class="col mb-2 mt-4">
            <p class="text-center" style="font-weight: 600; color: navy;">
                <a href="{{ route('register.form') }}" style="text-decoration: none;">Create Account</a>
            </p>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var toastElList = [].slice.call(document.querySelectorAll('.toast'));
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl, { delay: 3000 });
    });
    toastList.forEach(toast => toast.show());
</script>
</body>
</html>
