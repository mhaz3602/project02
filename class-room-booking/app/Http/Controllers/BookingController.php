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
        $booking = Booking::with('ruangan')->latest()->get();
        return view('booking.index', compact('booking'));
    }

    public function create(Request $request)
    {
        $ruanganTerpilih = null;

        if ($request->has('ruangan')) {
            $ruanganTerpilih = Ruangan::find($request->ruangan);
        }

        return view('booking.create', compact('ruanganTerpilih'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ruangan' => 'required|exists:ruangan,id',
            'nama' => 'required|string',
            'nim' => 'required|string',
            'no_telp' => 'required|string',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'keperluan' => 'required|string',
        ]);

        Booking::create([
            'id_ruangan' => $request->id_ruangan,
            'user_id' => auth()->id(),        // pakai user yang login
            'id_mahasiswa' => null,           // biarkan kosong
            'nama' => $request->nama,
            'nim' => $request->nim,
            'no_telp' => $request->no_telp,
            'tanggal' => $request->tanggal,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'keperluan' => $request->keperluan,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.riwayat')->with('success', 'Booking berhasil dibuat!');
    }

    public function riwayat(Request $request)
    {
        $query = Booking::with('ruangan')->orderByDesc('created_at');

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $riwayat = $query->get();

        return view('booking.riwayat', compact('riwayat'));
    }

    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('booking.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'keperluan' => 'required|string|max:100',
            'status' => 'required|in:pending,disetujui,ditolak,batal,selesai',
        ]);

        $booking->update($request->all());

        return redirect()->route('booking.index')->with('success', 'Booking diperbarui.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('booking.index')->with('success', 'Booking dihapus.');
    }

    // === Admin Fitur ===

    public function riwayatAdmin(Request $request)
    {
        $query = Booking::with('ruangan')->orderByDesc('created_at');

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $riwayat = $query->get();

        return view('admin.booking.riwayat-admin', compact('riwayat'));
    }

    public function validasiIndex()
    {
        $bookings = Booking::with('ruangan')
            ->where('status', 'pending')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.validasi-booking', compact('bookings'));
    }

    public function setujui($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'disetujui']);

        return redirect()->back()->with('success', 'Booking disetujui.');
    }

    public function tolak($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'ditolak']);

        return redirect()->back()->with('success', 'Booking ditolak.');
    }

    public function selesai($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'selesai']);

        return redirect()->back()->with('success', 'Booking ditandai selesai.');
    }

    public function batal($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'batal']);

        return redirect()->back()->with('success', 'Booking telah dibatalkan.');
    }
}
