<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use Carbon\Carbon;

class LaporanPeminjamanController extends Controller
{
    /**
     * Menampilkan laporan peminjaman berdasarkan bulan dan tahun yang dipilih (atau bulan berjalan secara default).
     */
    public function index(Request $request)
    {
        // Ambil bulan dan tahun dari request, jika tidak ada, gunakan bulan dan tahun saat ini
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);

        // Panggil fungsi helper untuk mendapatkan data booking yang sudah difilter
        $bookings = $this->getFilteredBookings($bulan, $tahun);

        // Hitung statistik ringkasan dan data untuk grafik
        $summary = $this->calculateSummary($bookings, $bulan, $tahun);

        // Kirim data bookings dan summary ke view
        return view('admin.laporan_peminjaman', compact('bookings', 'summary', 'bulan', 'tahun'));
    }

    /**
     * Fungsi helper untuk mengambil data booking yang sudah difilter.
     */
    private function getFilteredBookings($month, $year)
    {
        $bookings = Booking::with(['mahasiswa', 'ruangan'])
                            ->whereMonth('tanggal', $month)
                            ->whereYear('tanggal', $year)
                            ->orderBy('tanggal', 'asc')
                            ->orderBy('jam_mulai', 'asc')
                            ->get();

        return $bookings;
    }

    /**
     * Fungsi helper untuk menghitung statistik ringkasan dan menyiapkan data grafik.
     */
    private function calculateSummary($bookings, $month, $year)
    {
        $totalBookings = $bookings->count();
        $statusCounts = $bookings->groupBy('status')->map->count();

        // Inisialisasi semua status agar selalu ada, meskipun jumlahnya 0
        $summaryStatus = [
            'disetujui' => $statusCounts->get('disetujui', 0),
            'dibatalkan' => $statusCounts->get('dibatalkan', 0),
            'selesai' => $statusCounts->get('selesai', 0),
            'pending' => $statusCounts->get('pending', 0),
        ];

        // Menemukan ruangan paling sering dipinjam
        $mostBookedRoom = null;
        $roomCounts = $bookings->groupBy('ruangan.nama')->map->count();
        if ($roomCounts->isNotEmpty()) {
            $mostBookedRoom = $roomCounts->sortDesc()->keys()->first();
        }

        // --- Data untuk Grafik Status Peminjaman (Doughnut Chart) ---
        $statusChartLabels = array_map('ucfirst', array_keys($summaryStatus)); // Labels: Disetujui, Dibatalkan, dll.
        $statusChartData = array_values($summaryStatus); // Data: Jumlah masing-masing status
        $statusChartColors = [
            '#4CAF50', // Hijau untuk disetujui
            '#F44336', // Merah untuk dibatalkan
            '#2196F3', // Biru untuk selesai
            '#FFC107', // Kuning untuk pending
        ];

        // --- Data untuk Grafik Peminjaman Harian (Bar Chart) ---
        $daysInMonth = Carbon::createFromDate($year, $month, 1)->daysInMonth;
        $dailyBookings = array_fill(1, $daysInMonth, 0); // Inisialisasi array dengan 0 untuk setiap hari

        foreach ($bookings as $booking) {
            $day = Carbon::parse($booking->tanggal)->day;
            $dailyBookings[$day]++;
        }

        $dailyChartLabels = array_keys($dailyBookings); // Labels: 1, 2, 3, ... (tanggal)
        $dailyChartData = array_values($dailyBookings); // Data: Jumlah booking per tanggal

        return [
            'total_bookings' => $totalBookings,
            'status_counts' => $summaryStatus,
            'most_booked_room' => $mostBookedRoom,
            'charts' => [
                'status' => [
                    'labels' => $statusChartLabels,
                    'data' => $statusChartData,
                    'colors' => $statusChartColors,
                ],
                'daily' => [
                    'labels' => $dailyChartLabels,
                    'data' => $dailyChartData,
                ],
            ],
        ];
    }

    /**
     * Metode untuk mencetak laporan.
     * Ini akan mengembalikan view khusus cetak.
     */
    public function cetak(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $bookings = $this->getFilteredBookings($bulan, $tahun);
        $summary = $this->calculateSummary($bookings, $bulan, $tahun);

        // Mengembalikan view khusus untuk cetak
        return view('admin.laporan_peminjaman_cetak', compact('bookings', 'summary', 'bulan', 'tahun'));
    }
}
