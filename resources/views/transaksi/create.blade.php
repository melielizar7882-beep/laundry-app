@extends('layouts.app')

@section('content')
<h2 class="mb-3">Entri Transaksi Baru</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kode Invoice</label>
                <input type="text" name="kode_invoice" class="form-control" value="INV-{{ time() }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Member</label>
                <select name="id_member" class="form-control" required>
                    <option value="">-- Pilih Member --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->nama }} ({{ $member->tlp }})</option>
                    @endforeach
                </select>
            </div>

            <hr>
            <h4>Detail Paket Cucian</h4>
            <div class="mb-3">
                <label class="form-label">Pilih Paket Cucian</label>
                <select name="id_paket[]" class="form-control" required>
                    <option value="">-- Pilih Paket --</option>
                    @foreach($pakets as $paket)
                        <option value="{{ $paket->id }}">{{ $paket->nama_paket }} - Rp {{ number_format($paket->harga) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity (Qty / Kg)</label>
                <input type="number" step="0.01" name="qty[]" class="form-control" placeholder="Contoh: 3" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan[]" class="form-control" placeholder="Catatan tambahan cucian..."></textarea>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Transaksi</button>
            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection