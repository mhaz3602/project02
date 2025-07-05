<x-layouts.app title="Dashboard">
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center bg-white p-6 rounded-lg shadow">
            <!-- KIRI: GAMBAR -->
            <div>
                <img src="{{ asset('images/ruangan.jpeg') }}" alt="Ruangan" class="rounded-lg w-full h-auto">
            </div>

            <!-- KANAN: DESKRIPSI -->
            <div>
                <h2 class="text-2xl font-bold text-blue-700 mb-4">Selamat Datang di Aplikasi Peminjaman Ruangan</h2>
                <p class="text-gray-700 mb-4">
                    Aplikasi ini digunakan untuk memudahkan mahasiswa dalam melakukan peminjaman ruangan untuk keperluan akademik seperti diskusi kelompok, seminar, dan kegiatan lainnya.
                </p>
                <h4 class="text-lg font-semibold mb-2 text-gray-800">Syarat Peminjaman:</h4>
                <ul class="list-disc list-inside text-gray-600 space-y-1">
                    <li>Mahasiswa aktif STT-NF</li>
                    <li>Peminjaman dilakukan minimal H-1 sebelum penggunaan</li>
                    <li>Data harus lengkap dan benar</li>
                    <li>Ruangan tidak sedang digunakan</li>
                </ul>
            </div>
        </div>
    </div>
</x-layouts.app>
