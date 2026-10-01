<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pengelolaan Laundry</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Tambahan styling kustom agar sidebar lebih interaktif */
        .sidebar .nav-link {
            border-radius: 8px;
            transition: all 0.2s ease-in-out;
            color: #495057;
            font-weight: 500;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #e7f1ff;
            color: #0d6efd !important;
            transform: translateX(4px);
        }
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Navbar Atas dengan Nuansa Laundry Modern -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(135deg, #0d6efd 0%, #055160 100%);">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/dashboard">
                <div class="bg-white text-primary p-2 rounded-3 me-2 shadow-sm d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="fas fa-soap fa-lg"></i>
                </div>
                <span>Laundry App</span>
            </a>
            
            <div class="d-flex text-white align-items-center">
                <div class="d-none d-md-block text-end me-3">
                    <span class="d-block small opacity-75">Selamat Datang,</span>
                    <strong>{{ session('nama') }}</strong> <span class="badge bg-light text-primary text-uppercase ms-1">{{ session('role') }}</span>
                </div>
                <form action="/logout" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm px-3 shadow-sm rounded-pill">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Kiri -->
            <div class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse border-end min-vh-100 p-3 shadow-sm">
                <div class="text-uppercase text-muted fw-bold fs-7 px-3 mb-2 mt-1" style="font-size: 0.75rem;">Navigasi Utama</div>
                <ul class="nav flex-column gap-1">
                    <li class="nav-item">
                        <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home me-2 text-primary"></i> Dashboard
                        </a>
                    </li>
                    
                    @if(session('role') === 'admin')
                    <li class="nav-item">
                        <a href="/outlet" class="nav-link {{ request()->is('outlet*') ? 'active' : '' }}">
                            <i class="fas fa-store me-2 text-primary"></i> CRUD Outlet
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/paket" class="nav-link {{ request()->is('paket*') ? 'active' : '' }}">
                            <i class="fas fa-box me-2 text-primary"></i> CRUD Paket
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/user" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                            <i class="fas fa-users me-2 text-primary"></i> CRUD Pengguna
                        </a>
                    </li>
                    @endif

                    @if(in_array(session('role'), ['admin', 'kasir']))
                    <li class="nav-item">
                        <a href="/member" class="nav-link {{ request()->is('member*') ? 'active' : '' }}">
                            <i class="fas fa-user-friends me-2 text-primary"></i> Member Pelanggan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/transaksi" class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">
                            <i class="fas fa-cash-register me-2 text-primary"></i> Entri Transaksi
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="/laporan" class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt me-2 text-primary"></i> Generate Laporan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content Area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 border-start border-success border-4" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 border-start border-danger border-4" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>