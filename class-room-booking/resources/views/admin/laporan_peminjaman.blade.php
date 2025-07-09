{{-- Menggunakan komponen layout utama aplikasi Anda --}}
<x-layouts.app>

    {{-- Judul halaman laporan --}}
    @section('title', 'Laporan Peminjaman') 

    {{-- Konten utama halaman laporan --}}
    <div class="p-4 sm:p-6 lg:p-8 space-y-6"> {{-- Padding dan spacing responsif --}}
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Laporan Peminjaman Bulanan</h1>

        {{-- Card Filter Laporan --}}
        <div class="bg-white dark:bg-zinc-800 shadow-md rounded-lg p-6">
            <h6 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">Filter Laporan</h6>
            
            {{-- Form untuk memilih bulan dan tahun --}}
            <form action="{{ route('laporan.peminjaman') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div>
                        <label for="bulan" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Pilih Bulan:</label>
                        <select name="bulan" id="bulan" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white">
                            @php
                                $bulan_nama = [
                                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                                ];
                                $selected_month = request('bulan', date('n')); // Ambil dari request atau bulan saat ini
                            @endphp
                            @foreach ($bulan_nama as $num => $name)
                                <option value="{{ $num }}" {{ $num == $selected_month ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Pilih Tahun:</label>
                        <select name="tahun" id="tahun" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-zinc-700 text-zinc-900 dark:text-white">
                            @php
                                $current_year = date('Y');
                                $start_year = $current_year - 5; // Tampilkan 5 tahun ke belakang
                                $end_year = $current_year + 1;   // Tampilkan tahun ini dan 1 tahun ke depan
                                $selected_year = request('tahun', date('Y')); // Ambil dari request atau tahun saat ini
                            @endphp
                            @for ($year = $start_year; $year <= $end_year; $year++)
                                <option value="{{ $year }}" {{ $year == $selected_year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button type="submit" class="w-full md:w-auto px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">Tampilkan Laporan</button>
                        {{-- Tombol cetak, bisa dikembangkan nanti --}}
                        <a href="{{ route('laporan.peminjaman.cetak', ['bulan' => $selected_month, 'tahun' => $selected_year]) }}" target="_blank" class="w-full md:w-auto px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">Cetak Laporan</a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Card Data Peminjaman --}}
        <div class="bg-white dark:bg-zinc-800 shadow-md rounded-lg p-6">
            <h6 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">Data Peminjaman</h6>
            
            @if(isset($bookings) && $bookings->count() > 0)
                <div class="overflow-x-auto"> {{-- Untuk scroll horizontal di layar kecil --}}
                    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
                        <thead class="bg-zinc-50 dark:bg-zinc-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">No.</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Tanggal</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Waktu</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Ruangan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Peminjam</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Keperluan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach ($bookings as $index => $booking)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-zinc-900 dark:text-white">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-300">{{ \Carbon\Carbon::parse($booking->tanggal)->format('d F Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-300">{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-300">{{ $booking->ruangan->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-300">{{ $booking->nama }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-300">{{ $booking->keperluan }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @php
                                            $badge_class = '';
                                            switch($booking->status) {
                                                case 'disetujui': $badge_class = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'; break;
                                                case 'dibatalkan': $badge_class = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'; break;
                                                case 'selesai': $badge_class = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'; break;
                                                case 'pending': $badge_class = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'; break;
                                                default: $badge_class = 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300'; break;
                                            }
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badge_class }}">{{ ucfirst($booking->status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-zinc-500 dark:text-zinc-400">Tidak ada data peminjaman untuk periode yang dipilih.</p>
            @endif
        </div>
    </div>
</x-layouts.app>
