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

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (protected)
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Settings
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // ✅ Ruangan
    Route::resource('ruangan', RuanganController::class);
    
    // ✅ Booking
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::resource('booking', BookingController::class); // ini wajib ada

    // ✅ Riwayat Booking
    Route::get('/riwayat-booking', [BookingController::class, 'riwayat'])->name('booking.riwayat');
    
    // ✅ Kalender
    Route::get('/kalender', [KalenderController::class, 'index'])->name('kalender');

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

});

// Include auth routes
require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

      // 🏢 CRUD Ruangan
    Route::resource('/admin/ruangan', RuanganController::class)->names([
        'index' => 'admin.ruangan.index',
        'create' => 'admin.ruangan.create',
        'store' => 'admin.ruangan.store',
        'show' => 'admin.ruangan.show',
        'edit' => 'admin.ruangan.edit',
        'update' => 'admin.ruangan.update',
        'destroy' => 'admin.ruangan.destroy',
    ]);

    // ✅ Validasi Peminjaman Ruangan
    Route::get('/admin/validasi-booking', [BookingController::class, 'validasiIndex'])->name('booking.validasi');
    Route::post('/admin/validasi-booking/{id}/setujui', [BookingController::class, 'setujui'])->name('booking.setujui');
    Route::post('/admin/validasi-booking/{id}/tolak', [BookingController::class, 'tolak'])->name('booking.tolak');

    // 📅 Lihat Kalender Semua Booking
    Route::get('/admin/kalender', [KalenderController::class, 'adminKalender'])->name('admin.kalender');

    // 📖 Riwayat Semua Peminjaman
    Route::get('/admin/riwayat-booking', [BookingController::class, 'riwayatAdmin'])->name('booking.riwayat');

    // 📄 Laporan Peminjaman (misalnya dengan filter tanggal)
    Route::get('/admin/laporan-peminjaman', [LaporanController::class, 'index'])->name('laporan.peminjaman');
    Route::post('/admin/laporan-peminjaman/cetak', [LaporanController::class, 'cetak'])->name('laporan.peminjaman.cetak');
});


