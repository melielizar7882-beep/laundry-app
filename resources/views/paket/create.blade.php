@extends('layouts.app')

@section('content')
<h2 class="mb-3">Tambah Paket Cucian Baru</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('paket.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Outlet</label>
                <select name="id_outlet" class="form-control" required>
                    <option value="">-- Pilih Outlet --</option>
                    @foreach($outlets as $outlet)
                        <option value="{{ $outlet->id }}">{{ $outlet->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Cucian</label>
                <select name="jenis" class="form-control" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="kiloan">Kiloan</option>
                    <option value="selimut">Selimut</option>
                    <option value="bed_cover">Bed Cover</option>
                    <option value="kaos">Kaos</option>
                    <option value="lain">Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection