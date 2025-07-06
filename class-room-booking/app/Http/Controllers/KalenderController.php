<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class KalenderController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->input('bulan') ?? now()->month;
        $tahun = $request->input('tahun') ?? now()->year;

        $tanggal = Carbon::createFromDate($tahun, $bulan, 1);

        return view('kalender.index', compact('tanggal'));
    }
}