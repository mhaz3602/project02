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
                'nama' => 'Ruang Rapat Link And Match (Rapat Staff)',
                'kapasitas' => 25,
                'lokasi' => 'Gedung Kampus A, Lantai 3',
                'fasilitas' => 'AC, LCD Projector, Wifi, Kursi, Meja, Dispenser',
                'foto' => 'ruangrapat.jpeg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Dosen B2 103',
                'kapasitas' => 10,
                'lokasi' => 'Gedung Kampus B2 103, Lantai 1',
                'fasilitas' => 'Proyektor, AC, TV, Meja',
                'foto' => 'ruangdosen.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Kelas B2 201',
                'kapasitas' => 40,
                'lokasi' => 'Gedung Kampus B2 201, Lantai 2',
                'fasilitas' => 'AC, LCD Projector, WiFi, Kursi, Meja, Laptop',
                'foto' => 'ruangkelas.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Kelas B2 203',
                'kapasitas' => 40,
                'lokasi' => 'Gedung Kampus B2 203, Lantai 3',
                'fasilitas' => 'AC, LCD Projector, WiFi, Kursi, Meja, Laptop',
                'foto' => 'ruanganb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Kelas A 303',
                'kapasitas' => 40,
                'lokasi' => 'Gedung Kampus A 303, Lantai 3',
                'fasilitas' => 'AC, LCD Proyektor, Wifi, Kursi, Meja, Laptop',
                'foto' => 'ruangana.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Kelas B1 105',
                'kapasitas' => 25,
                'lokasi' => 'Gedung Kampus B1 105, Lantai 1',
                'fasilitas' => 'AC, LCD Projector, WiFi, Kursi, Whiteboard, Komputer',
                'foto' => 'ruanganlima.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
              [
                'nama' => 'Ruang Kelas B1 106',
                'kapasitas' => 20,
                'lokasi' => 'Gedung Kampus B1 106, Lantai 1',
                'fasilitas' => 'AC, LCD Projector, WiFi, Kursi, Whiteboard, Komputer',
                'foto' => 'ruanganc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Kelas A 403',
                'kapasitas' => 40,
                'lokasi' => 'Gedung Kampus A 403, Lantai 4',
                'fasilitas' => 'AC, LCD Proyektor, Wifi, Kursi, Meja',
                'foto' => 'ruangand.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'nama' => 'Ruang Rapat A 106',
                'kapasitas' => 6,
                'lokasi' => 'Gedung Kampus A 106, Lantai 3',
                'fasilitas' => 'AC, LCD Projector, Wifi, Kursi, Meja',
                'foto' => 'ruangane.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'nama' => 'Auditorium',
                'kapasitas' => 150,
                'lokasi' => 'Gedung Kampus B2, Lantai 1',
                'fasilitas' => 'AC, LCD Projector, WiFi, Kursi, Sofa Meja, Laptop',
                'foto' => 'ruanganf.webp',
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'nama' => 'Rooftop LT5',
                'kapasitas' => 150,
                'lokasi' => 'Gedung Kampus A, Lantai 5',
                'fasilitas' => 'AC, Meja, Kipas Angin',
                'foto' => 'rooftop.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
