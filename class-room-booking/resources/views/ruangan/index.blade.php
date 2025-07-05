<x-layouts.app title="Daftar Ruangan">
    <div class="p-6 space-y-6">
        <h2 class="text-2xl font-bold text-blue-700">Daftar Ruangan Tersedia</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($ruangan as $r)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <!-- Gambar ruangan -->
                    <img src="{{ asset('images/ruangan/' . $r->foto) }}" alt="{{ $r->nama }}" class="rounded-lg w-full h-40 object-cover">


                    <!-- Konten ruangan -->
                    <div class="p-4 space-y-2">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $r->nama }}</h3>
                        <p class="text-sm text-gray-600">Kapasitas: <strong>{{ $r->kapasitas }} orang</strong></p>
                        <p class="text-sm text-gray-600">Lokasi: {{ $r->lokasi }}</p>
                        @if($r->fasilitas)
                            <p class="text-sm text-gray-600">Fasilitas: {{ $r->fasilitas }}</p>
                        @endif

                        <!-- Tombol Pinjam -->
                        <div class="pt-3">
                            <a href="{{ route('booking.create', ['ruangan' => $r->id]) }}"
                               class="inline-block bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-blue-700 transition">
                                Pinjam Ruangan
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-600">Belum ada ruangan tersedia.</p>
            @endforelse
        </div>
    </div>
</x-layouts.app>
