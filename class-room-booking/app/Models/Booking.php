<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking'; // Pastikan nama tabel benar
    protected $fillable = [
        'id_mahasiswa',
        'id_ruangan',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'keperluan',
        'status',
    ];

    /**
     * Get the mahasiswa that owns the booking.
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    /**
     * Get the ruangan that owns the booking.
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}
