<x-layouts.app title="Kalender Booking Ruangan">
    <div class="p-6 space-y-6 bg-white min-h-screen">

        @php
            $prev = $tanggal->copy()->subMonth();
            $next = $tanggal->copy()->addMonth();
            $hariPertama = $tanggal->copy()->startOfMonth()->dayOfWeek;
            $jumlahHari = $tanggal->daysInMonth;
        @endphp

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('kalender', ['bulan' => $prev->month, 'tahun' => $prev->year]) }}"
               class="text-sm bg-blue-100 px-3 py-1 rounded hover:bg-blue-200 transition">« Sebelumnya</a>

            <h1 class="text-xl font-bold text-gray-800">{{ $tanggal->translatedFormat('F Y') }}</h1>

            <a href="{{ route('kalender', ['bulan' => $next->month, 'tahun' => $next->year]) }}"
               class="text-sm bg-blue-100 px-3 py-1 rounded hover:bg-blue-200 transition">Berikutnya »</a>
        </div>

        <div class="grid grid-cols-7 gap-2 text-center text-gray-700 font-semibold">
            @foreach(['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $day)
                <div class="bg-blue-100 py-2 rounded">{{ $day }}</div>
            @endforeach
        </div>

        <div class="grid grid-cols-7 gap-2">
            @for ($i = 0; $i < $hariPertama; $i++)
                <div></div>
            @endfor

            @for ($tgl = 1; $tgl <= $jumlahHari; $tgl++)
                <div class="border border-gray-200 p-2 min-h-[100px] rounded shadow-sm hover:shadow-md hover:border-blue-400 transition">
                    <div class="text-sm font-bold text-blue-600">{{ $tgl }}</div>
                    <div class="text-xs text-gray-500 italic">Belum ada booking</div>
                </div>
            @endfor
        </div>

        <footer class="text-xs text-center text-gray-400 mt-10 italic">
            Kalender dibuat untuk melihat ketersediaan ruangan setiap hari.
        </footer>
    </div>
</x-layouts.app>