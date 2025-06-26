<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('ruangan')
            ->where('id_mahasiswa', Auth::id())
            ->latest()
            ->get();

        return view('booking.riwayat', compact('bookings'));
    }

    public function edit($id)
    {
        $booking = Booking::where('id', $id)->where('id_mahasiswa', Auth::id())->firstOrFail();
        $ruangan = Ruangan::all();
        return view('booking.edit', compact('booking', 'ruangan'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::where('id', $id)->where('id_mahasiswa', Auth::id())->firstOrFail();

        // Validasi
        $request->validate([
            'id_ruangan' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required'
        ]);

        // Cek bentrok
        $bentrok = Booking::where('id_ruangan', $request->id_ruangan)
            ->where('tanggal', $request->tanggal)
            ->where('id', '!=', $id)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                  ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })->exists();

        if ($bentrok) {
            return back()->with('error', 'Jadwal bentrok dengan booking lain.');
        }

        $booking->update([
            'id_ruangan' => $request->id_ruangan,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
        ]);

        return redirect()->route('booking.riwayat')->with('success', 'Booking berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $booking = Booking::where('id', $id)->where('id_mahasiswa', Auth::id())->firstOrFail();

        $booking->update([
            'status' => 'dibatalkan'
        ]);

        return redirect()->route('booking.riwayat')->with('success', 'Booking berhasil dibatalkan.');
    }
}
