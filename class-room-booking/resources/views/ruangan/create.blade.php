@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Ruangan</h1>

    <form action="{{ route('ruangan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Ruangan</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Fasilitas</label>
            <textarea name="fasilitas" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan</button>
        <a href="{{ route('ruangan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsectio