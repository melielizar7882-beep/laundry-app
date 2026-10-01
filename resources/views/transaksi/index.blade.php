@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Entri Transaksi</h2>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Transaksi Baru</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Invoice</th>
                    <th>Member</th>
                    <th>Tgl Transaksi</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksis as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->kode_invoice }}</td>
                    <td>{{ $t->member->nama ?? '-' }}</td>
                    <td>{{ $t->tgl }}</td>
                    <td>
                        <span class="badge bg-{{ $t->status == 'selesai' ? 'success' : ($t->status == 'proses' ? 'warning' : 'primary') }}">
                            {{ strtoupper($t->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $t->dibayar == 'dibayar' ? 'success' : 'danger' }}">
                            {{ strtoupper(str_replace('_', ' ', $t->dibayar)) }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <!-- Form Update Status -->
                        <form action="{{ route('transaksi.updateStatus', $t->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm d-inline w-auto">
                                <option value="baru" {{ $t->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="proses" {{ $t->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $t->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="diambil" {{ $t->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                            </select>
                        </form>

                        @if($t->dibayar == 'belum_dibayar')
                        <form action="{{ route('transaksi.bayar', $t->id) }}" method="POST" class="d-inline ms-1">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi pembayaran lunas?')"><i class="fas fa-check"></i> Bayar</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection