<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruangan')->insert([
            [
                'nama' => 'Ruang Rapat A',
                'kapasitas' => 20,
                'lokasi' => 'Lantai 1',
                'fasilitas' => 'AC, Proyektor, Whiteboard',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Diskusi B',
                'kapasitas' => 10,
                'lokasi' => 'Lantai 2',
                'fasilitas' => 'Whiteboard, TV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Kelas C',
                'kapasitas' => 30,
                'lokasi' => 'Lantai 3',
                'fasilitas' => 'AC, Proyektor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Serbaguna D',
                'kapasitas' => 50,
                'lokasi' => 'Lantai Dasar',
                'fasilitas' => 'AC, Mic, Speaker',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Ruang Meeting VIP',
                'kapasitas' => 8,
                'lokasi' => 'Lantai 1',
                'fasilitas' => 'AC, Sofa, TV',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
