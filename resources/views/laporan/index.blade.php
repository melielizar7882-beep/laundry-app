@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Laporan Transaksi Laundry</h2>
    <button onclick="window.print()" class="btn btn-secondary"><i class="fas fa-print"></i> Cetak Laporan</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice</th>
                    <th>Outlet</th>
                    <th>Member</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Total Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach($transaksis as $t)
                @php $grandTotal += $t->total_harga; @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->kode_invoice }}</td>
                    <td>{{ $t->outlet->nama ?? '-' }}</td>
                    <td>{{ $t->member->nama ?? '-' }}</td>
                    <td>{{ $t->tgl }}</td>
                    <td>{{ strtoupper($t->status) }}</td>
                    <td>{{ strtoupper(str_replace('_', ' ', $t->dibayar)) }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="text-end">Total Pendapatan Keseluruhan:</th>
                    <th>Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection