<x-layouts.app title="Daftar Ruangan">
    <div class="p-6 space-y-10 bg-blue-50 min-h-screen">
        
        <!-- Judul -->
        <div class="text-center space-y-1">
            <h2 class="text-4xl font-extrabold text-blue-700 tracking-wide inline-block relative drop-shadow-sm">
                <span class="relative z-10 px-4">Daftar Ruangan Tersedia</span>
                <span class="absolute left-1/2 -translate-x-1/2 bottom-0 w-1/2 h-1 bg-blue-200 rounded-full blur-sm"></span>
            </h2>
            <p class="text-sm text-gray-500">
                Pilih ruangan terbaikmu, klik <span class="font-medium">"Pinjam Ruangan"</span> & nikmati kemudahan akses!
            </p>
        </div>

        <!-- Grid Ruangan -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($ruangan as $r)
                @php
                    $emoji = ['🏫','🏫','🧑‍🏫','🧑‍🏫','🧑‍🏫','🖥️','🖥️','🧑‍🏫','🛋️','🏢','🧑‍🏫'][($loop->index % 11)];
                    $badge = $r->kapasitas >= 100 ? 'bg-red-100 text-red-600' :
                             ($r->kapasitas >= 40 ? 'bg-yellow-100 text-yellow-700' :
                             'bg-green-100 text-green-700');
                @endphp

                <div class="flex flex-col bg-white/80 backdrop-blur-lg border border-gray-200 rounded-2xl shadow-md hover:shadow-2xl hover:border-blue-400 transition-all duration-300 transform hover:-translate-y-1 h-full min-h-[470px]">
                    
                    <!-- Gambar -->
                    <div class="relative overflow-hidden rounded-t-2xl">
                        <img src="{{ asset('images/ruangan/' . $r->foto) }}" alt="{{ $r->nama }}"
                             class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110 brightness-95">
                        <div class="absolute top-3 left-3 bg-blue-500 text-white text-xs px-3 py-1 rounded-full shadow-sm">
                            Tersedia
                        </div>
                        <div class="absolute top-3 right-3 text-2xl animate-bounce">{{ $emoji }}</div>
                    </div>

                    <!-- Konten -->
                    <div class="flex flex-col justify-between flex-grow p-5 bg-gradient-to-br from-white via-white to-blue-50 rounded-b-2xl">
                        <div class="space-y-3 mb-4">
                            <div class="min-h-[3.5rem]">
                                <h3 class="text-lg font-bold text-gray-800 break-words leading-tight text-left">
                                    {{ $r->nama }}
                                </h3>
                            </div>

                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $badge }}">
                                Kapasitas: {{ $r->kapasitas }} orang
                            </span>

                            <div class="flex items-start gap-3">
                                <x-heroicon-o-map-pin class="w-5 h-5 text-gray-400 mt-0.5" />
                                <p class="text-sm text-gray-700 leading-snug break-words">
                                    {{ $r->lokasi }}
                                </p>
                            </div>

                            @if($r->fasilitas)
                                <div class="flex items-start gap-3">
                                    <x-heroicon-o-cog-6-tooth class="w-5 h-5 text-gray-400 mt-0.5" />
                                    <p class="text-sm text-gray-700 leading-snug break-words">
                                        {{ $r->fasilitas }}
                                    </p>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol -->
                        <div>
                            <a href="{{ route('booking.create', ['ruangan' => $r->id]) }}"
                               class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white text-sm font-semibold px-4 py-2 rounded-xl hover:from-blue-600 hover:to-blue-800 transition-all duration-300 shadow-md hover:scale-[1.02]">
                                <x-heroicon-o-calendar class="w-5 h-5 text-white" />
                                <span>Pinjam Ruangan</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-24">
                    <p class="text-2xl font-semibold">📭 Belum ada ruangan yang tersedia saat ini.</p>
                    <p class="text-sm mt-2">Silakan kembali lagi nanti ya!</p>
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        <footer class="text-xs text-center text-gray-400 mt-16 italic">
            Sistem ini dibuat untuk memudahkan peminjaman ruangan. Gunakan dengan bijak dan tanggung jawab ya! 🙏
        </footer>
    </div>
</x-layouts.app>
