<x-layouts.app title="Edit Ruangan">
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-6">

        <h2 class="text-2xl font-bold text-blue-700 mb-6">✏️ Edit Ruangan</h2>

        <form action="{{ route('admin.ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nama" class="font-semibold">Nama Ruangan</label>
                <input type="text" name="nama" id="nama" class="form-input w-full" value="{{ old('nama', $ruangan->nama) }}" required>
                @error('nama') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="kapasitas" class="font-semibold">Kapasitas</label>
                <input type="number" name="kapasitas" id="kapasitas" class="form-input w-full" value="{{ old('kapasitas', $ruangan->kapasitas) }}" required>
                @error('kapasitas') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="lokasi" class="font-semibold">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="form-input w-full" value="{{ old('lokasi', $ruangan->lokasi) }}" required>
                @error('lokasi') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="fasilitas" class="font-semibold">Fasilitas</label>
                <textarea name="fasilitas" id="fasilitas" rows="3" class="form-textarea w-full">{{ old('fasilitas', $ruangan->fasilitas) }}</textarea>
                @error('fasilitas') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="foto" class="font-semibold">Ganti Foto (opsional)</label>
                <input type="file" name="foto" id="foto" class="form-file w-full">
                @error('foto') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

                @if ($ruangan->foto)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">Foto saat ini:</p>
                        <img src="{{ asset('storage/' . $ruangan->foto) }}" alt="Foto Ruangan" class="w-32 rounded shadow mt-1">
                    </div>
                @endif
            </div>

            <div class="pt-4">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Perbarui</button>
                <a href="{{ route('admin.ruangan.index') }}" class="ml-3 text-gray-500 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-layouts.app>
