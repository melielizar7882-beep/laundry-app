@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Detail Nota Transaksi</h2>
    <div>
        <button onclick="window.print()" class="btn btn-secondary"><i class="fas fa-print"></i> Cetak Nota</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</div>

<div class="card shadow-sm p-4">
    <div class="row mb-4">
        <div class="col-sm-6">
            <h4 class="text-primary fw-bold"><i class="fas fa-soap"></i> LAUNDRY APP</h4>
            <p class="mb-1">Outlet: <strong>{{ $transaksi->outlet->nama ?? '-' }}</strong></p>
            <p class="mb-1">{{ $transaksi->outlet->alamat ?? '-' }}</p>
            <p class="mb-0">Telepon: {{ $transaksi->outlet->tlp ?? '-' }}</p>
        </div>
        <div class="col-sm-6 text-sm-end">
            <h5 class="fw-bold">Invoice: {{ $transaksi->kode_invoice }}</h5>
            <p class="mb-1">Tanggal Transaksi: {{ $transaksi->tgl }}</p>
            <p class="mb-1">Batas Waktu: {{ $transaksi->batas_waktu }}</p>
            <p class="mb-1">Tanggal Bayar: {{ $transaksi->tgl_bayar ?? 'Belum Dibayar' }}</p>
        </div>
    </div>

    <hr>

    <div class="row mb-4">
        <div class="col-sm-6">
            <h5>Informasi Pelanggan (Member):</h5>
            <p class="mb-1"><strong>Nama:</strong> {{ $transaksi->member->nama ?? '-' }}</p>
            <p class="mb-1"><strong>Telepon:</strong> {{ $transaksi->member->tlp ?? '-' }}</p>
            <p class="mb-0"><strong>Alamat:</strong> {{ $transaksi->member->alamat ?? '-' }}</p>
        </div>
        <div class="col-sm-6 text-sm-end">
            <h5>Status & Petugas:</h5>
            <p class="mb-1"><strong>Status Cucian:</strong> 
                <span class="badge bg-{{ $transaksi->status == 'selesai' ? 'success' : ($transaksi->status == 'proses' ? 'warning' : 'primary') }}">
                    {{ strtoupper($transaksi->status) }}
                </span>
            </p>
            <p class="mb-1"><strong>Status Pembayaran:</strong> 
                <span class="badge bg-{{ $transaksi->dibayar == 'dibayar' ? 'success' : 'danger' }}">
                    {{ strtoupper(str_replace('_', ' ', $transaksi->dibayar)) }}
                </span>
            </p>
            <p class="mb-0"><strong>Kasir/Petugas:</strong> {{ $transaksi->user->nama ?? '-' }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Nama Paket</th>
                    <th>Jenis</th>
                    <th>Harga Satuan</th>
                    <th>Qty / Jumlah</th>
                    <th>Keterangan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi->detailTransaksi as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->paket->nama_paket ?? '-' }}</td>
                    <td>{{ ucfirst($detail->paket->jenis ?? '-') }}</td>
                    <td>Rp {{ number_format($detail->paket->harga ?? 0, 0, ',', '.') }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>{{ $detail->keterangan ?? '-' }}</td>
                    <td>Rp {{ number_format($detail->qty * ($detail->paket->harga ?? 0), 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6" class="text-end fw-bold">Biaya Tambahan:</td>
                    <td>Rp {{ number_format($transaksi->biaya_tambahan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-end fw-bold">Diskon:</td>
                    <td>Rp {{ number_format($transaksi->diskon, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="6" class="text-end fw-bold">Pajak:</td>
                    <td>Rp {{ number_format($transaksi->pajak, 0, ',', '.') }}</td>
                </tr>
                <tr class="table-active">
                    <td colspan="6" class="text-end fw-bold fs-5">Total Pembayaran:</td>
                    <td class="fw-bold fs-5 text-success">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="text-center mt-4 text-muted small">
        <p class="mb-0">Terima kasih telah mempercayakan laundry pakaian Anda kepada kami!</p>
    </div>
</div>
@endsection