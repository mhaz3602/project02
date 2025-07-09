@php use Illuminate\Support\Str; @endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-900 font-sans antialiased">
    <flux:sidebar 
        sticky 
        stashable 
        class="border-e border-zinc-200 bg-gradient-to-b from-blue-100 via-white to-blue-50 dark:from-zinc-900 dark:via-zinc-800 dark:to-zinc-900 shadow-md">

        <flux:sidebar.toggle class="lg:hidden mb-4" icon="x-mark" />

        <!-- Logo & Judul -->
        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" 
           class="me-5 mb-4 flex items-center space-x-3 px-4 rtl:space-x-reverse" wire:navigate>
            <x-app-logo class="w-8 h-8" />
            <div class="text-xl font-bold tracking-tight text-blue-700 dark:text-white">
                RuangNF
            </div>
        </a>

        <!-- Navigasi Utama -->
        <flux:navlist variant="outline">
            <flux:navlist.group heading="🧭 Navigasi Utama" class="px-2 pt-2 text-sm font-semibold text-zinc-500 dark:text-zinc-400">

                <flux:navlist.item :href="route('dashboard')" wire:navigate
                    class="{{ request()->routeIs('dashboard') 
                        ? 'bg-blue-600 text-white font-semibold' 
                        : 'transition-all duration-200 hover:bg-blue-200/50 text-blue-700 dark:text-white' }}">
                    🏠 Dashboard
                </flux:navlist.item>

                <flux:navlist.item :href="route('ruangan.index')" wire:navigate
                    class="{{ request()->routeIs('ruangan.*') 
                        ? 'bg-blue-600 text-white font-semibold' 
                        : 'transition-all duration-200 hover:bg-blue-200/50 text-blue-700 dark:text-white' }}">
                    🏢 Ruangan
                </flux:navlist.item>

                <flux:navlist.item :href="route('kalender')" wire:navigate
                    class="{{ request()->routeIs('kalender') 
                        ? 'bg-blue-600 text-white font-semibold' 
                        : 'transition-all duration-200 hover:bg-blue-200/50 text-blue-700 dark:text-white' }}">
                    📆 Kalender Booking 
                </flux:navlist.item>

                <flux:navlist.item :href="route('booking.riwayat')" wire:navigate
                    class="{{ request()->routeIs('booking.riwayat') 
                        ? 'bg-blue-600 text-white font-semibold' 
                        : 'transition-all duration-200 hover:bg-blue-200/50 text-blue-700 dark:text-white' }}">
                    📄 Riwayat Peminjaman
                </flux:navlist.item>

                @if (auth()->user()->isAdmin())
                    <flux:navlist.item :href="route('booking.validasi')" wire:navigate
                        class="{{ request()->routeIs('booking.validasi') 
                            ? 'bg-blue-600 text-white font-semibold' 
                            : 'transition-all duration-200 hover:bg-blue-200/50 text-blue-700 dark:text-white' }}">
                        ✅ Validasi Peminjaman
                    </flux:navlist.item>

                    <flux:navlist.item :href="route('admin.ruangan.index')" wire:navigate
                        class="{{ str_starts_with(Route::currentRouteName(), 'admin.ruangan.') 
                            ? 'bg-blue-600 text-white font-semibold' 
                            : 'transition-all duration-200 hover:bg-blue-200/50 text-blue-700 dark:text-white' }}">
                        ⚙️ Kelola Ruangan
                    </flux:navlist.item>

                    <flux:navlist.item :href="route('laporan.peminjaman')" wire:navigate
                        class="{{ request()->routeIs('laporan.peminjaman')
                            ? 'bg-blue-600 text-white font-semibold'
                            : 'transition-all duration-200 hover:bg-blue-200/50 text-blue-700 dark:text-white' }}">
                        📊 Laporan Peminjaman
</flux:navlist.item>
                @endif

            </flux:navlist.group>
        </flux:navlist>

        <!-- Eksternal -->
        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.group heading="🔗 Sumber Eksternal" class="px-2 pt-2 text-sm font-semibold text-zinc-500 dark:text-zinc-400">
                <flux:navlist.item href="https://github.com/laravel/livewire-starter-kit" target="_blank" class="text-blue-600 dark:text-blue-300">
                    💻 GitHub Repo
                </flux:navlist.item>
                <flux:navlist.item href="https://laravel.com/docs/starter-kits#livewire" target="_blank" class="text-blue-600 dark:text-blue-300">
                    📘 Dokumentasi
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>

        <!-- Footer -->
        <div class="text-xs text-center text-gray-400 px-4 pb-4 mt-auto">
            <hr class="my-3 border-gray-300 dark:border-zinc-700" />
            <p>© {{ date('Y') }} STT-NF | v1.0</p>
        </div>

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()" icon:trailing="chevrons-up-down" />
            <flux:menu class="w-[240px]">
                <div class="px-3 py-2 text-sm text-zinc-600 dark:text-white">
                    <div class="font-semibold">{{ auth()->user()->name }}</div>
                    <div class="text-xs">{{ auth()->user()->email }}</div>
                </div>
                <flux:menu.separator />
                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                    Pengaturan Akun
                </flux:menu.item>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        Keluar
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile Header -->
    <flux:header class="lg:hidden px-4">
        <flux:sidebar.toggle icon="bars-2" />
        <flux:spacer />
        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />
            <flux:menu>
                <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                    Pengaturan
                </flux:menu.item>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle">
                        Keluar
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <!-- Konten Halaman -->
    {{ $slot }}

    @fluxScripts
</body>
</html>
