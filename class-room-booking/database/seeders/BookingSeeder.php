<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('booking')->insert([
            [
                'id_mahasiswa' => 1,
                'id_ruangan' => 1,
                'nama' => 'Uci Ananda',
                'nim' => '20211001',
                'no_telp' => '081234567890',
                'tanggal' => '2025-07-03',
                'jam_mulai' => '09:00:00',
                'jam_selesai' => '11:00:00',
                'keperluan' => 'Rapat organisasi',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 2,
                'id_ruangan' => 2,
                'nama' => 'Fahmi Aziz',
                'nim' => '20211002',
                'no_telp' => '081234567891',
                'tanggal' => '2025-07-04',
                'jam_mulai' => '13:00:00',
                'jam_selesai' => '15:00:00',
                'keperluan' => 'Persiapan presentasi',
                'status' => 'disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 3,
                'id_ruangan' => 3,
                'nama' => 'Dita Maharani',
                'nim' => '20211003',
                'no_telp' => '081234567892',
                'tanggal' => '2025-07-05',
                'jam_mulai' => '10:00:00',
                'jam_selesai' => '12:00:00',
                'keperluan' => 'Latihan debat',
                'status' => 'selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 4,
                'id_ruangan' => 1,
                'nama' => 'Yoga Saputra',
                'nim' => '20211004',
                'no_telp' => '081234567893',
                'tanggal' => '2025-07-06',
                'jam_mulai' => '14:00:00',
                'jam_selesai' => '16:00:00',
                'keperluan' => 'Bimbingan skripsi',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => 5,
                'id_ruangan' => 2,
                'nama' => 'Dimas Raka',
                'nim' => '20211005',
                'no_telp' => '081234567894',
                'tanggal' => '2025-07-07',
                'jam_mulai' => '08:00:00',
                'jam_selesai' => '10:00:00',
                'keperluan' => 'Rapat kelompok tugas',
                'status' => 'dibatalkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
