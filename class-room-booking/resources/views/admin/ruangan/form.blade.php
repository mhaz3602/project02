{{-- resources/views/admin/ruangan/form.blade.php --}}

<div class="mb-3">
    <label>Nama Ruangan</label>
    <input type="text" name="nama" class="form-control" value="{{ old('nama', $ruangan->nama ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Kapasitas</label>
    <input type="number" name="kapasitas" class="form-control" value="{{ old('kapasitas', $ruangan->kapasitas ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Lokasi</label>
    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $ruangan->lokasi ?? '') }}" required>
</div>

<div class="mb-3">
    <label>Fasilitas (opsional)</label>
    <textarea name="fasilitas" class="form-control">{{ old('fasilitas', $ruangan->fasilitas ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label>Foto (opsional)</label>
    <input type="file" name="foto" class="form-control">
    @if (!empty($ruangan->foto))
        <img src="{{ asset('storage/' . $ruangan->foto) }}" width="100" class="mt-2" alt="Foto Sebelumnya">
    @endif
</div>

<button class="btn btn-primary">{{ $submit }}</button>
<a href="{{ route('admin.ruangan.index') }}" class="btn btn-secondary">Kembali</a>
