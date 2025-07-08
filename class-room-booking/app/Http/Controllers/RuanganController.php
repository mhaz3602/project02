<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RuanganController extends Controller
{
    /**
     * Menampilkan daftar ruangan.
     * Untuk admin akan diarahkan ke tampilan admin.
     * Untuk user biasa ke tampilan umum.
     */
    public function index()
    {
        $ruangan = Ruangan::all();

        // Cek apakah user adalah admin dan sedang akses /admin/*
        if (auth()->check() && auth()->user()->isAdmin() && request()->is('admin/*')) {
            return view('admin.ruangan.index', compact('ruangan'));
        }

        return view('ruangan.index', compact('ruangan'));
    }

    /**
     * Menampilkan form tambah ruangan (khusus admin).
     */
    public function create()
    {
        $this->authorizeAdmin();
        return view('admin.ruangan.create');
    }

    /**
     * Menyimpan data ruangan baru (khusus admin).
     */
    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'fasilitas' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'kapasitas', 'lokasi', 'fasilitas']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('images/ruangan', 'public');
        }

        Ruangan::create($data);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit ruangan (khusus admin).
     */
    public function edit(Ruangan $ruangan)
    {
        $this->authorizeAdmin();
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    /**
     * Menyimpan perubahan pada ruangan (khusus admin).
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama' => 'required|string|max:100',
            'kapasitas' => 'required|integer|min:1',
            'lokasi' => 'required|string|max:255',
            'fasilitas' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'kapasitas', 'lokasi', 'fasilitas']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($ruangan->foto && Storage::disk('public')->exists($ruangan->foto)) {
                Storage::disk('public')->delete($ruangan->foto);
            }
            $data['foto'] = $request->file('foto')->store('images/ruangan', 'public');
        }

        $ruangan->update($data);

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui');
    }

    /**
     * Menghapus data ruangan (khusus admin).
     */
    public function destroy(Ruangan $ruangan)
    {
        $this->authorizeAdmin();

        // Hapus foto jika ada
        if ($ruangan->foto && Storage::disk('public')->exists($ruangan->foto)) {
            Storage::disk('public')->delete($ruangan->foto);
        }

        $ruangan->delete();

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus');
    }

    /**
     * Mengecek apakah user adalah admin.
     */
    private function authorizeAdmin()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang diperbolehkan.');
        }
    }
}
