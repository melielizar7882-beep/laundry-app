@extends('layouts.app')

@section('content')
<h2 class="mb-3">Edit Data Outlet</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('outlet.update', $outlet->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Outlet</label>
                <input type="text" name="nama" class="form-control" value="{{ $outlet->nama }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $outlet->alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="tlp" class="form-control" value="{{ $outlet->tlp }}" required>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Perbarui</button>
            <a href="{{ route('outlet.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection