<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking'; // Pastikan nama tabel benar
    protected $fillable = [

        'id_ruangan', 
        'id_mahasiswa',  // tetap ada, tapi nullable
        'user_id',       // tambah ini
        'nama', 
        'nim', 
        'no_telp', 
        'tanggal', 
        'jam_mulai', 
        'jam_selesai', 
        'keperluan', 
        'status'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }


     public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}
