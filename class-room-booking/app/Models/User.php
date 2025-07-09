<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens; // Baris ini dihapus jika Anda tidak menggunakan Sanctum untuk API token

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable; // HasApiTokens dihapus dari sini
    use HasFactory, Notifiable; // Hanya HasFactory dan Notifiable yang dipertahankan

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan kolom 'role' ada di tabel 'users' di database Anda
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Cek apakah user adalah admin.
     * Method ini akan mengembalikan true jika role user adalah 'admin'.
     * Pastikan kolom 'role' ada di tabel 'users' di database Anda
     * dan nilainya adalah 'admin' untuk user admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Mengambil inisial dari nama user.
     * Contoh: "John Doe" -> "JD"
     */
    public function initials()
    {
        $words = explode(' ', $this->name);
        $initials = '';

        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }

        // Jika nama kosong atau tidak ada kata, kembalikan default (misal: 'U' untuk User)
        return !empty($initials) ? $initials : 'U';
    }
}
