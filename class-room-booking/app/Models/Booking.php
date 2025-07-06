<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $fillable = [
    'id_ruangan',
    'id_mahasiswa',
    'nama',
    'nim',
    'no_telp',
    'tanggal',
    'jam_mulai',
    'jam_selesai',
    'keperluan',
    'status'
];



    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}
