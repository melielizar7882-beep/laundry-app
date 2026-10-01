@extends('layouts.app')

@section('content')
<h2 class="mb-3">Edit Paket Cucian</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('paket.update', $paket->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Outlet</label>
                <select name="id_outlet" class="form-control" required>
                    @foreach($outlets as $outlet)
                        <option value="{{ $outlet->id }}" {{ $paket->id_outlet == $outlet->id ? 'selected' : '' }}>{{ $outlet->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Cucian</label>
                <select name="jenis" class="form-control" required>
                    <option value="kiloan" {{ $paket->jenis == 'kiloan' ? 'selected' : '' }}>Kiloan</option>
                    <option value="selimut" {{ $paket->jenis == 'selimut' ? 'selected' : '' }}>Selimut</option>
                    <option value="bed_cover" {{ $paket->jenis == 'bed_cover' ? 'selected' : '' }}>Bed Cover</option>
                    <option value="kaos" {{ $paket->jenis == 'kaos' ? 'selected' : '' }}>Kaos</option>
                    <option value="lain" {{ $paket->jenis == 'lain' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Paket</label>
                <input type="text" name="nama_paket" class="form-control" value="{{ $paket->nama_paket }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="{{ $paket->harga }}" required>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Perbarui</button>
            <a href="{{ route('paket.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection