<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\KalenderController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LaporanController;

// =======================
// Public (Guest) Routes
// =======================

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

// Register
Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

// Logout
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// =======================
// Authenticated Routes
// =======================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Settings
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // CRUD Ruangan (User)
    Route::resource('ruangan', RuanganController::class);

    // Booking (User)
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking/{booking}/edit', [BookingController::class, 'edit'])->name('booking.edit');
    Route::put('/booking/{booking}', [BookingController::class, 'update'])->name('booking.update');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');

    // Riwayat & Kalender (User)
    Route::get('/riwayat-booking', [BookingController::class, 'riwayat'])->name('booking.riwayat');
    Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender');

    // Ganti Role (Admin <-> Mahasiswa)
    Route::post('/switch-role', function () {
        $user = auth()->user();
        $newRole = $user->isAdmin() ? 'mahasiswa' : 'admin';
        $user->update(['role' => $newRole]);

        return redirect()->back()->with('success', 'Role berhasil diganti menjadi ' . ucfirst($newRole));
    })->name('switch-role');
});

// =======================
// Admin Routes
// =======================
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // CRUD Ruangan (Admin)
    Route::resource('/admin/ruangan', RuanganController::class)->names([
        'index' => 'admin.ruangan.index',
        'create' => 'admin.ruangan.create',
        'store' => 'admin.ruangan.store',
        'show' => 'admin.ruangan.show',
        'edit' => 'admin.ruangan.edit',
        'update' => 'admin.ruangan.update',
        'destroy' => 'admin.ruangan.destroy',
    ]);

    // Validasi Peminjaman
    Route::get('/admin/validasi-booking', [BookingController::class, 'validasiIndex'])->name('booking.validasi');
    Route::post('/admin/validasi-booking/{id}/setujui', [BookingController::class, 'setujui'])->name('booking.setujui');
    Route::post('/admin/validasi-booking/{id}/tolak', [BookingController::class, 'tolak'])->name('booking.tolak');
    Route::post('/admin/validasi-booking/{id}/selesai', [BookingController::class, 'selesai'])->name('booking.selesai');
    Route::post('/admin/validasi-booking/{id}/batal', [BookingController::class, 'batal'])->name('booking.batal');


    // Kalender, Riwayat, Laporan
    Route::get('/admin/kalender', [KalenderController::class, 'adminKalender'])->name('admin.kalender');
    Route::get('/admin/riwayat-booking', [BookingController::class, 'riwayatAdmin'])->name('admin.booking.riwayat');

    Route::get('/admin/laporan-peminjaman', [LaporanController::class, 'index'])->name('laporan.peminjaman');
    Route::post('/admin/laporan-peminjaman/cetak', [LaporanController::class, 'cetak'])->name('laporan.peminjaman.cetak');
});

// =======================
// Livewire / Fortify etc
// =======================
require __DIR__ . '/auth.php';
