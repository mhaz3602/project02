<x-layouts.app title="Dashboard Admin">
    <div class="p-6 bg-gradient-to-br from-gray-50 via-white to-gray-100 min-h-screen">

        {{-- Container --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white/90 p-8 rounded-2xl shadow-2xl backdrop-blur-sm">

            {{-- KIRI: GAMBAR --}}
            <div class="relative group overflow-hidden rounded-xl">

                {{-- Ornamen & Ilustrasi --}}
                <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 z-10">
                    <img src="{{ asset('images/admin-avatar.png') }}" alt="Admin"
                         class="w-28 h-28 animate-pulse drop-shadow-lg">
                </div>

                <img src="{{ asset('images/dashboard-admin.jpg') }}"
                     alt="Dashboard Admin"
                     class="rounded-xl w-full h-auto transform group-hover:scale-105 transition duration-300 ease-in-out shadow-md mt-16">

                {{-- Bulatan Ornamen --}}
                <div class="absolute -top-5 -left-5 w-20 h-20 bg-purple-300/30 rounded-full blur-xl"></div>
                <div class="absolute bottom-2 right-2 w-14 h-14 bg-purple-200/40 rounded-full blur-md"></div>

                <div class="absolute top-2 right-2 text-4xl animate-bounce">🛠️</div>
            </div>

            {{-- KANAN: FITUR --}}
            <div>
                <h2 class="text-3xl font-extrabold text-purple-800 mb-4 drop-shadow">
                    Selamat Datang, Admin 👋
                </h2>

                <p class="text-gray-700 text-base mb-6 leading-relaxed text-justify">
                    Ini adalah pusat kontrol admin untuk mengelola semua proses peminjaman ruangan. Pastikan setiap permintaan dicek dengan teliti, dan ruangan tersedia sesuai jadwal yang ditentukan.
                </p>

                {{-- Quotes --}}
                <blockquote class="italic text-sm text-gray-500 bg-purple-50 px-4 py-2 rounded-md mb-6 border-l-4 border-purple-400">
                    “Admin hebat bukan yang banyak bicara, tapi yang tahu semua jadwal.” 😎
                </blockquote>

                {{-- Navigasi Admin --}}
                <div class="grid grid-cols-1 gap-3 text-sm">
                    <a href="{{ route('ruangan.index') }}"
                       class="flex items-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-4 py-2 rounded-xl shadow hover:from-blue-600 hover:to-blue-800 transition-all">
                        🏢 Kelola Ruangan
                    </a>
                    <a href="{{ route('booking.validasi') }}"
                       class="flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-700 text-white px-4 py-2 rounded-xl shadow hover:from-green-600 hover:to-green-800 transition-all">
                        ✅ Validasi Peminjaman
                    </a>
                    <a href="{{ route('kalender') }}"
                       class="flex items-center gap-2 bg-gradient-to-r from-indigo-500 to-indigo-700 text-white px-4 py-2 rounded-xl shadow hover:from-indigo-600 hover:to-indigo-800 transition-all">
                        📅 Lihat Kalender
                    </a>
                    <a href="{{ route('booking.riwayat') }}"
                       class="flex items-center gap-2 bg-gradient-to-r from-yellow-500 to-yellow-700 text-white px-4 py-2 rounded-xl shadow hover:from-yellow-600 hover:to-yellow-800 transition-all">
                        📖 Riwayat Peminjaman
                    </a>
                    <a href="{{ route('laporan.peminjaman') }}"
                       class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-red-700 text-white px-4 py-2 rounded-xl shadow hover:from-red-600 hover:to-red-800 transition-all">
                        📄 Laporan Peminjaman
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
