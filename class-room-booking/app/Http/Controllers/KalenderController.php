<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking; // pastikan model Booking sudah diimport
use Carbon\Carbon;

class KalenderController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->month;
        $tahun = $request->input('tahun') ?? now()->year;

        $tanggal = Carbon::createFromDate($tahun, $bulan, 1);

        // Ambil semua booking di bulan dan tahun yang dipilih
        $bookings = Booking::whereMonth('tanggal', $bulan)
                           ->whereYear('tanggal', $tahun)
                           ->get()
                           ->groupBy(function ($item) {
                               return Carbon::parse($item->tanggal)->day; // Kelompokkan berdasarkan tanggal
                           });

        return view('kalender.index', compact('tanggal', 'bookings'));
    }
}
