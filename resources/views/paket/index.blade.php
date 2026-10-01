@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Paket Cucian</h2>
    <a href="{{ route('paket.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Paket</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Outlet</th>
                    <th>Jenis</th>
                    <th>Nama Paket</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pakets as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->outlet->nama ?? '-' }}</td>
                    <td><span class="badge bg-info text-dark">{{ $p->jenis }}</span></td>
                    <td>{{ $p->nama_paket }}</td>
                    <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('paket.edit', $p->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('paket.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection