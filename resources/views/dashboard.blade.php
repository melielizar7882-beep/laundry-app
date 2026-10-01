@extends('layouts.app')

@section('content')
<!-- Banner Sambutan dengan Nuansa Laundry -->
<div class="p-5 mb-4 rounded-3 shadow-sm border text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);">
    <div class="container-fluid py-2">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold mb-3"><i class="fas fa-soap me-2"></i> Selamat Datang, {{ session('nama') }}!</h1>
                <p class="fs-5 mb-4 opacity-75">Sistem Pengelolaan Outlet Laundry siap membantu mencatat transaksi dan manajemen cucian hari ini dengan cepat dan rapi.</p>
                <a href="{{ route('transaksi.create') }}" class="btn btn-light text-primary fw-bold px-4 py-2 shadow-sm">
                    <i class="fas fa-plus-circle me-1"> + Entri Transaksi Baru</i>
                </a>
            </div>
            <div class="col-md-4 text-center d-none d-md-block">
                <i class="fas fa-tshirt fa-7x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Kotak Statistik Utama -->
<div class="row mb-4">
    <!-- Total Outlet -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow-sm h-100 py-2 border-primary border-top-0 border-bottom-0 border-end-0 border-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Outlet Cabang</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahOutlet }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-store fa-2x text-primary opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Paket Cucian -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow-sm h-100 py-2 border-success border-top-0 border-bottom-0 border-end-0 border-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-success text-uppercase mb-1">Jenis Paket Cucian</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahPaket }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box-open fa-2x text-success opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Member -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow-sm h-100 py-2 border-info border-top-0 border-bottom-0 border-end-0 border-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-info text-uppercase mb-1">Total Pelanggan Member</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahMember }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-info opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Transaksi -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow-sm h-100 py-2 border-warning border-top-0 border-bottom-0 border-end-0 border-4">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">Total Entri Transaksi</div>
                        <div class="h5 mb-0 fw-bold text-gray-800">{{ $jumlahTransaksi }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-receipt fa-2x text-warning opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahan Bagian Informasi / Status Laundry Cepat -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle me-1"></i> Informasi Sistem Laundry</h6>
            </div>
            <div class="card-body">
                <p class="text-muted">Aplikasi ini berjalan dengan hak akses <strong class="text-uppercase text-dark">{{ session('role') }}</strong>. Gunakan menu navigasi di sebelah kiri untuk mengelola data master seperti Outlet, Paket Harga, Data Pengguna, Registrasi Member Pelanggan, hingga memproses Nota Pembayaran dan Laporan Laundry.</p>
                <hr>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-primary p-2"><i class="fas fa-check me-1"></i> Manajemen Multi-Outlet Aktif</span>
                    <span class="badge bg-success p-2"><i class="fas fa-check me-1"></i> Perhitungan Kilat & Satuan</span>
                    <span class="badge bg-info text-dark p-2"><i class="fas fa-check me-1"></i> Status Laundry (Baru, Proses, Selesai, Diambil)</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection