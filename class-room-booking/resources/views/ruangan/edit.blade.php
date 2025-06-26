@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ruangan</h1>

    <form action="{{ route('ruangan.update', $ruangan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nama Ruangan</label>
            <input type="text" name="nama" value="{{ $ruangan->nama }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Kapasitas</label>
            <input type="number" name="kapasitas" value="{{ $ruangan->kapasitas }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Lokasi</label>
            <input type="text" name="lokasi" value="{{ $ruangan->lokasi }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Fasilitas</label>
            <textarea name="fasilitas" class="form-control" rows="3">{{ $ruangan->fasilitas }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('ruangan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection