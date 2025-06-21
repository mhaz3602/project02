<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class KalenderController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['mahasiswa', 'ruangan'])->get()->map(function ($booking) {
            return [
                'title' => $booking->ruangan->nama_ruangan . ' - ' . $booking->keperluan,
                'start' => $booking->tanggal . ' ' . $booking->jam_mulai,
                'end' => $booking->tanggal . ' ' . $booking->jam_selesai,
                'status' => $booking->status,
            ];
        });


        return view('kalender', ['events' => $bookings]);
    }
}
