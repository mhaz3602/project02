<x-layouts.app title="Kalender Booking Ruangan">
    <div class="p-6 space-y-6 bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen">

        @php
            $prev = $tanggal->copy()->subMonth();
            $next = $tanggal->copy()->addMonth();
            $hariPertama = $tanggal->copy()->startOfMonth()->dayOfWeek;
            $jumlahHari = $tanggal->daysInMonth;
        @endphp

        <!-- Navigasi Bulan -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('kalender', ['bulan' => $prev->month, 'tahun' => $prev->year]) }}"
               class="text-sm px-4 py-2 bg-white border border-blue-200 rounded-full shadow hover:bg-blue-50 transition">
               ← {{ $prev->translatedFormat('F') }}
            </a>

            <h1 class="text-2xl font-extrabold text-blue-700 tracking-wide">
                {{ $tanggal->translatedFormat('F Y') }}
            </h1>

            <a href="{{ route('kalender', ['bulan' => $next->month, 'tahun' => $next->year]) }}"
               class="text-sm px-4 py-2 bg-white border border-blue-200 rounded-full shadow hover:bg-blue-50 transition">
               {{ $next->translatedFormat('F') }} →
            </a>
        </div>

        <!-- Header Hari -->
        <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-600">
            @foreach(['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                <div class="bg-blue-200/40 py-2 rounded-lg shadow-sm text-sm">{{ $day }}</div>
            @endforeach
        </div>

        <!-- Tanggal -->
        <div class="grid grid-cols-7 gap-2">
            @for ($i = 0; $i < $hariPertama; $i++)
                <div></div>
            @endfor

            @for ($tgl = 1; $tgl <= $jumlahHari; $tgl++)
                <div class="bg-white p-2 rounded-xl border border-gray-200 shadow hover:shadow-lg hover:border-blue-400 transition-all min-h-[100px] relative group">

                    <div class="text-sm font-bold text-blue-700">{{ $tgl }}</div>

                    @if(isset($bookings[$tgl]))
                        <ul class="mt-1 space-y-1">
                            @foreach($bookings[$tgl] as $b)
                                <li class="text-xs text-gray-700 bg-blue-50 rounded px-2 py-1 shadow-sm">
                                    {{ $b->nama }} - {{ \Carbon\Carbon::parse($b->jam_mulai)->format('H:i') }}-{{ \Carbon\Carbon::parse($b->jam_selesai)->format('H:i') }}
                                </li>
                            @endforeach
                        </ul>

                        <div class="absolute top-2 right-2 text-xs animate-bounce">📌</div>
                    @else
                        <div class="mt-1 text-xs text-gray-400 italic group-hover:text-blue-600 transition">
                            Belum ada booking
                        </div>
                        <div class="absolute top-2 right-2 text-xs">📅</div>
                    @endif
                </div>
            @endfor
        </div>

        <footer class="text-xs text-center text-gray-400 mt-10 italic">
            Gunakan kalender ini untuk memantau ketersediaan ruangan kampus setiap harinya.
        </footer>
    </div>
</x-layouts.app>
