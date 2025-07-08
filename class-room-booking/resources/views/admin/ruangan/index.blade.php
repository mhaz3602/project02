<x-layouts.app title="Kelola Ruangan">
    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-blue-700">🏢 Kelola Ruangan</h2>
            <a href="{{ route('admin.ruangan.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 shadow">
                ➕ Tambah Ruangan
            </a>
        </div>

        <!-- Flash Success -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto bg-white rounded shadow">
                <thead class="bg-blue-100 text-blue-700 text-left text-sm">
                    <tr>
                        <th class="px-4 py-2">#</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Kapasitas</th>
                        <th class="px-4 py-2">Lokasi</th>
                        <th class="px-4 py-2">Fasilitas</th>
                        <th class="px-4 py-2">Foto</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-sm text-gray-700">
                    @forelse($ruangan as $index => $r)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 font-semibold">{{ $r->nama }}</td>
                            <td class="px-4 py-2">{{ $r->kapasitas }} org</td>
                            <td class="px-4 py-2">{{ $r->lokasi }}</td>
                            <td class="px-4 py-2">{{ $r->fasilitas ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if($r->foto)
                                    <img src="{{ asset('storage/' . $r->foto) }}"
                                         alt="Foto {{ $r->nama }}"
                                         class="w-20 h-14 object-cover rounded shadow">
                                @else
                                    <span class="text-gray-400 italic">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('admin.ruangan.edit', $r->id) }}"
                                   class="text-sm text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.ruangan.destroy', $r->id) }}" method="POST"
                                      class="inline-block"
                                      onsubmit="return confirm('Yakin ingin menghapus ruangan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500 italic">
                                Belum ada ruangan terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
