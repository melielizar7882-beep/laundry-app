@extends('layouts.app')

@section('content')
<h2 class="mb-3">Edit Data Member</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('member.update', $member->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama" class="form-control" value="{{ $member->nama }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ $member->alamat }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" {{ $member->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                    <option value="P" {{ $member->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="tlp" class="form-control" value="{{ $member->tlp }}" required>
            </div>
            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Perbarui</button>
            <a href="{{ route('member.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection