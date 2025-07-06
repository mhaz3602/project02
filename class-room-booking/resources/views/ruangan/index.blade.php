<x-layouts.app title="Daftar Ruangan">
    <div class="p-6 space-y-10 bg-gray-50 min-h-screen">
        
        <!-- Judul & Subjudul -->
        <div class="text-center space-y-1">
            <h2 class="text-4xl font-extrabold text-blue-700 tracking-wide inline-block relative drop-shadow-sm">
                <span class="relative z-10 px-4">Daftar Ruangan Tersedia</span>
                <span class="absolute left-1/2 -translate-x-1/2 bottom-0 w-1/2 h-1 bg-blue-200 rounded-full blur-sm"></span>
            </h2>
            <p class="text-sm text-gray-500">
                Pilih ruangan yang tersedia dan klik tombol <span class="font-medium">"Pinjam Ruangan"</span> untuk mulai booking.
            </p>
        </div>

        <!-- Grid Ruangan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($ruangan as $r)
                <div class="flex flex-col bg-white/80 backdrop-blur-lg border border-gray-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-blue-400 transition-all duration-300 transform hover:-translate-y-1 h-full min-h-[470px]">
                    
                    <!-- Gambar -->
                    <div class="relative overflow-hidden rounded-t-2xl">
                        <img src="{{ asset('images/ruangan/' . $r->foto) }}" alt="{{ $r->nama }}"
                             class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                        <div class="absolute top-3 left-3 bg-blue-500 text-white text-xs px-3 py-1 rounded-full shadow-sm">
                            Tersedia
                        </div>
                    </div>

                    <!-- Konten -->
                    <div class="flex flex-col justify-between flex-grow p-5 bg-gradient-to-br from-white via-white to-blue-50 rounded-b-2xl">
                        <div class="space-y-3 mb-4">
                            <div class="min-h-[3.5rem]"> <!-- Biar semua nama ruangan rapi dan sejajar -->
                                <h3 class="text-lg font-bold text-gray-800 break-words leading-tight text-left">
                                    {{ $r->nama }}
                                </h3>
                            </div>

                            <div class="flex items-start gap-3">
                                <x-heroicon-o-user-group class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" />
                                <p class="text-sm text-gray-700 leading-snug break-words">
                                    Kapasitas: {{ $r->kapasitas }} orang
                                </p>
                            </div>

                            <div class="flex items-start gap-3">
                                <x-heroicon-o-map-pin class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" />
                                <p class="text-sm text-gray-700 leading-snug break-words">
                                    Lokasi: {{ $r->lokasi }}
                                </p>
                            </div>

                            @if($r->fasilitas)
                                <div class="flex items-start gap-3">
                                    <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-gray-400 flex-shrink-0 mt-0.5" />
                                    <p class="text-sm text-gray-700 leading-snug break-words">
                                        Fasilitas: {{ $r->fasilitas }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol -->
                        <div>
                            <a href="{{ route('booking.create', ['ruangan' => $r->id]) }}"
                               class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-500 to-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-xl hover:from-indigo-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:scale-[1.02]">
                                <x-heroicon-o-calendar class="w-5 h-5 text-gray-300" />
                                <span>Pinjam Ruangan</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <footer class="text-xs text-center text-gray-400 mt-16 italic">
            Sistem ini dibuat untuk memudahkan peminjaman ruangan. Gunakan dengan bijak ya.
        </footer>
    </div>
</x-layouts.app>
