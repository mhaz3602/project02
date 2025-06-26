<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nama',
        'NIM',
        'jurusan',
        'email',
        'password',
    ];

    /**
     * Relasi: Mahasiswa memiliki banyak Booking
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'id_mahasiswa');
    }
}
