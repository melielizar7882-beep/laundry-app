<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 350px;">
        <h3 class="text-center mb-4">Login Laundry</h3>
        
        @if(session('error'))
            <div class="alert alert-danger p-2 small">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success p-2 small">{{ session('success') }}</div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-2">Masuk</button>
<div class="text-center mt-2">
    <a href="{{ route('register') }}" class="text-decoration-none small">Belum punya akun? Daftar</a>
</div>
        </form>
    </div>
</body>
</html>