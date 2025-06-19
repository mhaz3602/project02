<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'id_mahasiswa',
        'id_ruangan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keperluan',
        'status'
    ];
}
