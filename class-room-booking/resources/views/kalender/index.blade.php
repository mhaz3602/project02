<x-layouts.app title="Kalender Booking Ruangan">
    <div class="p-6 space-y-6 bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen font-sans">

        @php
            $prev = $tanggal->copy()->subMonth();
            $next = $tanggal->copy()->addMonth();
            $hariPertama = $tanggal->copy()->startOfMonth()->dayOfWeek;
            $jumlahHari = $tanggal->daysInMonth;
        @endphp

        <!-- Navigasi Bulan -->
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('kalender', ['bulan' => $prev->month, 'tahun' => $prev->year]) }}"
               class="text-sm px-4 py-2 bg-white border border-blue-300 rounded-full shadow hover:bg-blue-50 transition font-medium text-blue-700">
               ← {{ $prev->translatedFormat('F') }}
            </a>

            <h1 class="text-2xl font-bold text-blue-800 tracking-tight">
                {{ $tanggal->translatedFormat('F Y') }}
            </h1>

            <a href="{{ route('kalender', ['bulan' => $next->month, 'tahun' => $next->year]) }}"
               class="text-sm px-4 py-2 bg-white border border-blue-300 rounded-full shadow hover:bg-blue-50 transition font-medium text-blue-700">
               {{ $next->translatedFormat('F') }} →
            </a>
        </div>

        <!-- Header Hari -->
        <div class="grid grid-cols-7 gap-2 text-center font-semibold text-gray-700">
            @foreach(['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                <div class="bg-blue-200/50 py-2 rounded-lg shadow-sm text-sm">
                    {{ $day }}
                </div>
            @endforeach
        </div>

        <!-- Tanggal -->
        <div class="grid grid-cols-7 gap-2">
            @for ($i = 0; $i < $hariPertama; $i++)
                <div></div>
            @endfor

            @for ($tgl = 1; $tgl <= $jumlahHari; $tgl++)
                @php
                    $isBooked = isset($bookings[$tgl]);
                @endphp

                <div class="p-3 rounded-xl border transition-all duration-300 min-h-[100px] relative group
                    {{ $isBooked ? 'bg-blue-100 border-blue-400 text-blue-900 shadow-md' : 'bg-white border-gray-200 text-gray-500 hover:border-blue-300 hover:shadow-md' }}">
                    
                    <!-- Tanggal -->
                    <div class="text-base font-bold">{{ $tgl }}</div>

                    @if($isBooked)
                        <ul class="mt-2 space-y-1">
                            @foreach($bookings[$tgl] as $b)
                                <li class="text-xs bg-blue-50 text-blue-800 rounded px-2 py-1 shadow-sm">
                                    {{ $b->nama }}<br>
                                    <span class="font-medium">
                                        {{ \Carbon\Carbon::parse($b->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($b->jam_selesai)->format('H:i') }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="absolute top-2 right-2 text-lg animate-bounce">📌</div>
                    @else
                        <div class="mt-3 text-xs italic group-hover:text-blue-700 transition">
                            Belum ada booking
                        </div>
                        <div class="absolute top-2 right-2 text-lg">📅</div>
                    @endif
                </div>
            @endfor
        </div>

        <!-- Footer -->
        <footer class="text-xs text-center text-gray-500 mt-10 italic">
            Gunakan kalender ini untuk memantau ketersediaan ruangan setiap harinya.
        </footer>
    </div>
</x-layouts.app>
