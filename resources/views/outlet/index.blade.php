@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Data Outlet</h2>
    <a href="{{ route('outlet.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Outlet</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Outlet</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($outlets as $o)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $o->nama }}</td>
                    <td>{{ $o->alamat }}</td>
                    <td>{{ $o->tlp }}</td>
                    <td>
                        <a href="{{ route('outlet.edit', $o->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('outlet.destroy', $o->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus outlet ini?')">
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