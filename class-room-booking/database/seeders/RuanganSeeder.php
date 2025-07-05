<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data lama
        DB::table('ruangan')->delete();

        // Masukkan data ruangan baru
        DB::table('ruangan')->insert([
            [
                'nama' => 'Ruang Seminar 1',
                'kapasitas' => 30,
                'lokasi' => 'Gedung A, Lt. 1',
                'fasilitas' => 'Proyektor, AC, Whiteboard',
                'foto' => 'ruanganb.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Rapat 2',
                'kapasitas' => 20,
                'lokasi' => 'Gedung B, Lt. 2',
                'fasilitas' => 'AC, Meja Rapat, WiFi',
                'foto' => 'ruanganc.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Diskusi 3',
                'kapasitas' => 15,
                'lokasi' => 'Gedung C, Lt. 3',
                'fasilitas' => 'WiFi, Papan Tulis',
                'foto' => 'ruangand.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Presentasi 4',
                'kapasitas' => 40,
                'lokasi' => 'Gedung A, Lt. 2',
                'fasilitas' => 'Proyektor, Mic, Panggung',
                'foto' => 'b303.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Workshop 5',
                'kapasitas' => 25,
                'lokasi' => 'Gedung D, Lt. 1',
                'fasilitas' => 'Laptop, WiFi, Whiteboard',
                'foto' => 'ruangana.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}