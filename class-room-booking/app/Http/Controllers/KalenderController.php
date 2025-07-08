<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;

class KalenderController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->month;
        $tahun = $request->input('tahun') ?? now()->year;

        $tanggal = Carbon::createFromDate($tahun, $bulan, 1);

        // Ambil hanya booking yang disetujui
        $bookings = Booking::whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->where('status', 'disetujui') // hanya yang disetujui tampil di kalender
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->tanggal)->day;
            });

        return view('kalender.index', compact('tanggal', 'bookings'));
    }
}
