<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Logging masuk ke store
        Log::info('🔵 Masuk ke store register', ['request' => $request->all()]);

        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            // Simpan user ke database
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log sukses
            Log::info('✅ User berhasil dibuat', ['user' => $user]);

            // Redirect ke login
            return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silakan login.');

        } catch (\Exception $e) {
            // Log error
            Log::error('❌ Gagal membuat user', ['error' => $e->getMessage()]);

            // Redirect balik dengan pesan error
            return back()->withErrors(['register' => 'Terjadi kesalahan saat membuat akun.']);
        }
    }
}
