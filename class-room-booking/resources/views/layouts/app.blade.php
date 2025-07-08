<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Aplikasi Booking')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .sidebar {
            min-height: 100vh;
            background: #1f1f1f;
            border-right: 1px solid #2c2c2c;
        }
        .sidebar a {
            color: #ddd;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #333;
            color: #fff;
        }
        .active-link {
            background: #0d6efd;
            color: #fff !important;
        }
    </style>

    @stack('styles')
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-white mb-4">☁️ Booking App</h4>

            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active-link' : '' }}">🏠 Dashboard</a>
            <a href="{{ route('ruangan.index') }}" class="{{ request()->routeIs('ruangan.*') && !request()->routeIs('admin.ruangan.*') ? 'active-link' : '' }}">🏢 Ruangan</a>
            <a href="{{ route('kalender') }}" class="{{ request()->routeIs('kalender') ? 'active-link' : '' }}">📆 Kalender</a>
            <a href="{{ route('booking.riwayat') }}" class="{{ request()->routeIs('booking.riwayat') ? 'active-link' : '' }}">📄 Riwayat</a>

            @if (auth()->check() && auth()->user()->isAdmin())
                <hr class="text-secondary">
                <a href="{{ route('booking.validasi') }}" class="{{ request()->routeIs('booking.validasi') ? 'active-link' : '' }}">✅ Validasi Peminjaman</a>
                <a href="{{ route('admin.ruangan.index') }}" class="{{ request()->routeIs('admin.ruangan.*') ? 'active-link' : '' }}">🛠️ Kelola Ruangan</a>
            @endif

            <hr class="text-secondary">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100 mt-2">Keluar</button>
            </form>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
