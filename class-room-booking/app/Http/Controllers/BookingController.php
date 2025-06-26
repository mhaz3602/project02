<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Tampilkan form booking
    // public function create()
    // {
    //     $ruangan = Ruangan::all();
    //     return view('booking.form', compact('ruangan'));
    // }

    // // Simpan data booking
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_ruangan' => 'required|exists:ruangan,id',
    //         'tanggal' => 'required|date',
    //         'jam_mulai' => 'required',
    //         'jam_selesai' => 'required|after:jam_mulai',
    //         'keperluan' => 'required|string',
    //     ]);

    //     // Cek bentrok jadwal
    //     $bentrok = Booking::where('id_ruangan', $request->id_ruangan)
    //         ->where('tanggal', $request->tanggal)
    //         ->where(function ($query) use ($request) {
    //             $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
    //                 ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
    //                 ->orWhere(function ($q) use ($request) {
    //                     $q->where('jam_mulai', '<', $request->jam_mulai)
    //                         ->where('jam_selesai', '>', $request->jam_selesai);
    //                 });
    //         })
    //         ->exists();

    //     if ($bentrok) {
    //         return back()->withErrors(['msg' => 'Ruangan sudah dibooking pada waktu tersebut.']);
    //     }

    //     Booking::create([
    //         'id_mahasiswa' => Auth::id(), // ID dari user yang login
    //         'id_ruangan' => $request->id_ruangan,
    //         'tanggal' => $request->tanggal,
    //         'jam_mulai' => $request->jam_mulai,
    //         'jam_selesai' => $request->jam_selesai,
    //         'keperluan' => $request->keperluan,
    //         'status' => 'disetujui',
    //     ]);

    //     return redirect()->route('booking.riwayat')->with('success', 'Booking berhasil dibuat!');
    // }

    // // Tampilkan riwayat booking mahasiswa
    // public function riwayat()
    // {
    //     $riwayat = Booking::where('id_mahasiswa', Auth::id())
    //         ->with('ruangan') // agar bisa ambil nama ruangan
    //         ->orderBy('tanggal', 'desc')
    //         ->get();

    //     return view('booking.riwayat', compact('riwayat'));
    // }

    public function index()
    {
        return view('booking');
    }
}
