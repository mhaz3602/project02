<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Statistik Peminjaman Bulanan - {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->format('F Y') }}</title>
    {{-- Memuat Tailwind CSS dari CDN untuk tampilan cetak --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gaya khusus untuk cetak */
        @page {
            size: A4 portrait; /* Ukuran kertas A4, orientasi portrait */
            margin: 2cm; /* Margin halaman */
        }
        body {
            font-family: 'Inter', sans-serif; /* Font Inter */
            color: #333; /* Warna teks default */
            -webkit-print-color-adjust: exact; /* Memastikan warna latar belakang dicetak */
            print-color-adjust: exact;
        }
        .report-container {
            width: 100%;
            max-width: 21cm; /* Lebar maksimum untuk A4 */
            margin: 0 auto;
            padding: 1cm;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #e2e8f0; /* border-zinc-200 */
            padding: 0.75rem;
            text-align: left;
            font-size: 0.875rem; /* text-sm */
        }
        th {
            background-color: #f8fafc; /* bg-zinc-50 */
            font-weight: 600; /* font-semibold */
            color: #475569; /* text-zinc-500 */
            text-transform: uppercase;
        }
        .badge {
            display: inline-flex;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem; /* text-xs */
            line-height: 1;
            font-weight: 600; /* font-semibold */
            border-radius: 9999px; /* rounded-full */
        }
        /* Warna badge */
        .badge-success { background-color: #d1fae5; color: #065f46; } /* bg-green-100 text-green-800 */
        .badge-danger { background-color: #fee2e2; color: #991b1b; } /* bg-red-100 text-red-800 */
        .badge-info { background-color: #dbeafe; color: #1e40af; } /* bg-blue-100 text-blue-800 */
        .badge-warning { background-color: #fffbeb; color: #92400e; } /* bg-yellow-100 text-yellow-800 */
        .badge-secondary { background-color: #e5e7eb; color: #4b5563; } /* bg-gray-100 text-gray-800 */

        /* Sembunyikan elemen yang tidak perlu dicetak */
        .no-print {
            display: none !important;
        }

        /* Gaya untuk chart (tidak akan dicetak sebagai grafik interaktif, tapi bisa jadi placeholder) */
        .chart-container {
            width: 100%;
            height: 300px; /* Tinggi tetap untuk cetak */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0; /* Warna latar belakang placeholder */
            color: #666;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .chart-placeholder {
            text-align: center;
        }
    </style>
</head>
<body class="bg-white">
    <div class="report-container">
        <header class="text-center mb-8">
            <h1 class="text-3xl font-bold text-zinc-900 mb-2">Laporan Statistik Peminjaman Ruangan</h1>
            <p class="text-xl text-zinc-700">Periode: {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->format('F Y') }}</p>
        </header>

        {{-- Bagian Statistik Ringkasan --}}
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-blue-700 mb-4">Statistik Ringkasan</h2>
            {{-- Grid dari 5 kolom diubah menjadi 4 kolom karena 'Selesai' dihapus --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 text-center">
                <div class="p-4 bg-blue-50 rounded-lg shadow-sm border border-blue-200">
                    <p class="text-2xl font-bold text-blue-700">{{ $summary['total_bookings'] }}</p>
                    <p class="text-sm text-zinc-500">Total Peminjaman</p>
                </div>
                <div class="p-4 bg-green-50 rounded-lg shadow-sm border border-green-200">
                    <p class="text-2xl font-bold text-green-700">{{ $summary['status_counts']['disetujui'] }}</p>
                    <p class="text-sm text-zinc-500">Disetujui</p>
                </div>
                <div class="p-4 bg-yellow-50 rounded-lg shadow-sm border border-yellow-200">
                    <p class="text-2xl font-bold text-yellow-700">{{ $summary['status_counts']['pending'] }}</p>
                    <p class="text-sm text-zinc-500">Pending</p>
                </div>
                {{-- Peminjaman Selesai (DIHAPUS) --}}
                {{--
                <div class="p-4 bg-gray-50 rounded-lg shadow-sm border border-gray-200">
                    <p class="text-2xl font-bold text-gray-700">{{ $summary['status_counts']['selesai'] }}</p>
                    <p class="text-sm text-zinc-500">Selesai</p>
                </div>
                --}}
                {{-- Peminjaman Dibatalkan (termasuk Ditolak) --}}
                <div class="p-4 bg-red-50 rounded-lg shadow-sm border border-red-200">
                    <p class="text-2xl font-bold text-red-700">{{ $summary['status_counts']['dibatalkan'] }}</p>
                    <p class="text-sm text-zinc-500">Dibatalkan</p>
                </div>
            </div>
            @if($summary['most_booked_room'])
                <div class="mt-4 p-4 bg-zinc-50 rounded-lg shadow-sm text-center border border-zinc-200">
                    <p class="text-sm text-zinc-700">Ruangan Paling Sering Dipinjam: <span class="font-semibold text-blue-600">{{ $summary['most_booked_room'] }}</span></p>
                </div>
            @endif
        </section>

        {{-- Bagian Grafik (Placeholder untuk cetak) --}}
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-blue-700 mb-4">Visualisasi Data</h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="chart-container">
                    <p class="chart-placeholder">Grafik Distribusi Status Peminjaman (tidak interaktif saat dicetak)</p>
                </div>
                <div class="chart-container">
                    <p class="chart-placeholder">Grafik Peminjaman Harian (tidak interaktif saat dicetak)</p>
                </div>
            </div>
        </section>

        {{-- Bagian Tabel Detail Peminjaman --}}
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-blue-700 mb-4">Detail Peminjaman</h2>
            @if(isset($bookings) && $bookings->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Ruangan</th>
                            <th>Peminjam</th>
                            <th>Keperluan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                            case 'disetujui': $badge_class = 'badge-success'; break;
                                            case 'dibatalkan': $badge_class = 'badge-danger'; break;
                                            case 'selesai': $badge_class = 'badge-info'; break; // Ini tidak akan terpakai lagi di data
                                            case 'pending': $badge_class = 'badge-warning'; break;
                                            case 'ditolak': $badge_class = 'badge-danger'; break; // Tambahkan ini jika status 'ditolak' masih ada di DB dan ingin ditampilkan secara spesifik di tabel
                                            default: $badge_class = 'badge-secondary'; break;
                                        }
                                    @endphp
                                    <span class="badge {{ $badge_class }}">{{ ucfirst($booking->status) }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-zinc-500">Tidak ada data peminjaman untuk periode yang dipilih.</p>
            @endif
        </section>

        <footer class="text-center text-sm text-zinc-500 mt-12 pt-4 border-t border-zinc-200">
            <p>Laporan dibuat pada: {{ \Carbon\Carbon::now()->format('d F Y H:i') }}</p>
            <p>&copy; {{ date('Y') }} RuangNF. Semua hak dilindungi.</p>
        </footer>
    </div>

    <script>
        // Otomatis mencetak saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
