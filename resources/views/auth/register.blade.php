<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aplikasi Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-3">Registrasi Laundry</h3>
        
        @if(session('error'))
            <div class="alert alert-danger p-2 small">{{ session('error') }}</div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
    <label class="form-label">Pilih Outlet</label>
    <select name="id_outlet" class="form-control @error('id_outlet') is-invalid @enderror" required>
        <option value="">-- Pilih Outlet --</option>
        @foreach(\App\Models\Outlet::all() as $outlet)
            <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
        @endforeach
    </select>
    @error('id_outlet')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Role / Hak Akses</label>
    <select name="role" class="form-control @error('role') is-invalid @enderror" required>
        <option value="">-- Pilih Role --</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success w-100 mb-2">Daftar Sekarang</button>
            <a href="{{ route('login') }}" class="btn btn-link w-100 text-decoration-none text-muted small">Sudah punya akun? Login</a>
        </form>
    </div>
</body>
</html>