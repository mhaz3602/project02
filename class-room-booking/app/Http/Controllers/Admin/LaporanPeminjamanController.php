<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking; // Pastikan ini mengarah ke model Booking Anda
use App\Models\Ruangan; // Pastikan ini mengarah ke model Ruangan Anda
use App\Models\Mahasiswa; // Pastikan ini mengarah ke model Mahasiswa Anda
use Carbon\Carbon; // Digunakan untuk memanipulasi tanggal

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

        // Panggil fungsi helper untuk mendapatkan data yang sudah difilter
        $bookings = $this->getFilteredBookings($bulan, $tahun);

        // Kirim data bookings ke view
        return view('admin.laporan_peminjaman', compact('bookings'));
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
     * Metode untuk mencetak laporan (belum diimplementasikan, ini hanya placeholder).
     * Anda bisa mengembangkan ini nanti untuk ekspor PDF/Excel.
     */
    public function cetak(Request $request)
    {
        // Logika untuk mencetak laporan (misalnya, generate PDF atau Excel)
        // Akan memerlukan library tambahan seperti DomPDF atau Maatwebsite/Excel
        // Anda bisa mengambil data dengan cara yang sama seperti di method index
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $bookings = $this->getFilteredBookings($bulan, $tahun);

        // Contoh sederhana: mengembalikan string atau view khusus cetak
        return "Fitur cetak laporan untuk bulan {$bulan} tahun {$tahun} akan dikembangkan di sini.";
    }
}
