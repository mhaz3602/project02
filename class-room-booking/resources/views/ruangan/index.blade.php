@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Ruangan</h1>
    <a href="{{ route('ruangan.create') }}" class="btn btn-primary mb-3">Tambah Ruangan</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kapasitas</th>
                <th>Lokasi</th>
                <th>Fasilitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ruangan as $r)
            <tr>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->kapasitas }}</td>
                <td>{{ $r->lokasi }}</td>
                <td>{{ $r->fasilitas }}</td>
                <td>
                    <a href="{{ route('ruangan.edit', $r->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('ruangan.destroy', $r->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin mau hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection