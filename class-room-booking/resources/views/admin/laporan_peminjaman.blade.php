{{-- Menggunakan komponen layout utama aplikasi Anda --}}
<x-layouts.app>

    {{-- Judul halaman laporan --}}
    @section('title', 'Laporan Statistik Peminjaman Bulanan') 

    {{-- Konten utama halaman laporan --}}
    <div class="p-4 sm:p-6 lg:p-8 space-y-6"> {{-- Padding dan spacing responsif --}}
        <h1 class="text-2xl font-bold text-zinc-900 dark:text-white mb-6">Laporan Statistik Peminjaman Bulanan</h1>

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
                        {{-- Tombol cetak --}}
                        <a href="{{ route('laporan.peminjaman.cetak', ['bulan' => $selected_month, 'tahun' => $selected_year]) }}" target="_blank" class="w-full md:w-auto px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-zinc-800">Cetak Laporan</a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Bagian Statistik Ringkasan --}}
        <div class="bg-white dark:bg-zinc-800 shadow-md rounded-lg p-6">
            <h6 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">Statistik Ringkasan Peminjaman</h6>
            {{-- Grid dari 5 kolom diubah menjadi 4 kolom karena 'Selesai' dihapus --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-4 text-center"> 
                {{-- Total Peminjaman --}}
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-blue-700 dark:text-blue-300">{{ $summary['total_bookings'] }}</p>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Total Peminjaman</p>
                </div>
                {{-- Peminjaman Disetujui --}}
                <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-green-700 dark:text-green-300">{{ $summary['status_counts']['disetujui'] }}</p>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Disetujui</p>
                </div>
                {{-- Peminjaman Pending --}}
                <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-yellow-700 dark:text-yellow-300">{{ $summary['status_counts']['pending'] }}</p>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Pending</p>
                </div>
                {{-- Peminjaman Dibatalkan (termasuk Ditolak) --}}
                <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-red-700 dark:text-red-300">{{ $summary['status_counts']['dibatalkan'] }}</p>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Dibatalkan</p>
                </div>
                {{-- Peminjaman Selesai (DIHAPUS) --}}
                {{--
                <div class="p-4 bg-gray-50 dark:bg-gray-900/20 rounded-lg shadow-sm">
                    <p class="text-2xl font-bold text-gray-700 dark:text-gray-300">{{ $summary['status_counts']['selesai'] }}</p>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Selesai</p>
                </div>
                --}}
            </div>

            @if($summary['most_booked_room'])
                <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-700 rounded-lg shadow-sm text-center">
                    <p class="text-sm text-zinc-700 dark:text-zinc-300">Ruangan Paling Sering Dipinjam: <span class="font-semibold text-blue-600 dark:text-blue-300">{{ $summary['most_booked_room'] }}</span></p>
                </div>
            @endif
        </div>

        {{-- Bagian Grafik --}}
        <div class="bg-white dark:bg-zinc-800 shadow-md rounded-lg p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div>
                <h6 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">Distribusi Status Peminjaman</h6>
                <canvas id="statusChart" class="max-h-80"></canvas> {{-- Grafik Donat --}}
            </div>
            <div>
                <h6 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">Peminjaman Harian</h6>
                <canvas id="dailyChart" class="max-h-80"></canvas> {{-- Grafik Batang --}}
            </div>
        </div>

        {{-- Card Data Peminjaman (Tabel) --}}
        <div class="bg-white dark:bg-zinc-800 shadow-md rounded-lg p-6">
            <h6 class="text-lg font-semibold text-blue-700 dark:text-blue-400 mb-4">Detail Peminjaman</h6>
            
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
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->tanggal)->format('d F Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</td>
                                    <td>{{ $booking->ruangan->nama }}</td>
                                    <td>{{ $booking->nama }}</td>
                                    <td>{{ $booking->keperluan }}</td>
                                    <td>
                                        @php
                                            $badge_class = '';
                                            switch($booking->status) {
                                                case 'disetujui': $badge_class = 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'; break;
                                                case 'dibatalkan': $badge_class = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'; break;
                                                case 'selesai': $badge_class = 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300'; break; // Ini tidak akan terpakai lagi di data
                                                case 'pending': $badge_class = 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'; break;
                                                case 'ditolak': $badge_class = 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'; break; // Tambahkan ini jika status 'ditolak' masih ada di DB dan ingin ditampilkan secara spesifik di tabel
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

    @push('scripts')
    {{-- Memuat Chart.js dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data dari Laravel, di-encode sebagai JSON
            const chartData = @json($summary['charts']);

            // --- Grafik Donat (Distribusi Status) ---
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: chartData.status.labels,
                    datasets: [{
                        data: chartData.status.data,
                        backgroundColor: chartData.status.colors,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: 'rgb(156 163 175)' // Warna teks label di dark mode
                            }
                        },
                        title: {
                            display: false,
                            text: 'Distribusi Status Peminjaman'
                        }
                    }
                }
            });

            // --- Grafik Batang (Peminjaman Harian) ---
            const dailyCtx = document.getElementById('dailyChart').getContext('2d');
            new Chart(dailyCtx, {
                type: 'bar',
                data: {
                    labels: chartData.daily.labels,
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: chartData.daily.data,
                        backgroundColor: '#3B82F6', // Warna biru Tailwind (blue-500/600)
                        borderColor: '#2563EB',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Tidak perlu legend untuk satu dataset
                        },
                        title: {
                            display: false,
                            text: 'Peminjaman Harian'
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tanggal',
                                color: 'rgb(156 163 175)'
                            },
                            ticks: {
                                color: 'rgb(156 163 175)'
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)' // Garis grid samar di dark mode
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah',
                                color: 'rgb(156 163 175)'
                            },
                            ticks: {
                                color: 'rgb(156 163 175)',
                                stepSize: 1 // Pastikan skala integer jika jumlahnya kecil
                            },
                            grid: {
                                color: 'rgba(156, 163, 175, 0.1)'
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-layouts.app>
