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

    public function create(Request $request)
    {
        // Ganti 'ruangan_id' dengan 'ruangan'
        $ruanganId = $request->query('ruangan') ?? $request->query('ruangan_id');
        $ruanganTerpilih = Ruangan::find($ruanganId);

        if (!$ruanganTerpilih) {
            abort(404, 'Ruangan tidak ditemukan.');
        }

        return view('booking.create', compact('ruanganTerpilih'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required',
            'nama' => 'required|string',
            'nim' => 'required|string',
            'no_telp' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required|string'
        ]);


        $bentrok = Booking::where('id_ruangan', $request->id_ruangan)
            ->where('tanggal', $request->tanggal)
            ->where(function ($q) use ($request) {
                $q->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai]);
            })->exists();

        if ($bentrok) {
            return back()->with('error', 'Jadwal bentrok dengan booking lain.');
        }

        $request->validate([
            'id_ruangan' => 'required',
            'nama' => 'required|string',
            'nim' => 'required|string',
            'no_telp' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required|string'
        ]);

        return redirect()->route('booking')->with('success', 'Booking berhasil diajukan!');
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

        $request->validate([
            'id_ruangan' => 'required',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required'
        ]);

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
