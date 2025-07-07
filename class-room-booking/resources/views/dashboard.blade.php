<x-layouts.app title="Dashboard">
    <div class="p-6 bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen">

        {{-- Container --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center bg-white/90 p-8 rounded-2xl shadow-2xl backdrop-blur-sm">

            {{-- KIRI: GAMBAR --}}
            <div class="relative group overflow-hidden rounded-xl">

                {{-- Ilustrasi Tambahan di Atas --}}
                <div class="absolute -top-16 left-1/2 transform -translate-x-1/2 z-10">
                    <img src="{{ asset('images/ilustrasi-laptop.png') }}" alt="Ilustrasi Mahasiswa"
                         class="w-32 h-32 animate-pulse drop-shadow-lg">
                </div>

                {{-- Gambar Utama --}}
                <img src="{{ asset('images/ruangan.jpeg') }}"
                     alt="Ruangan"
                     class="rounded-xl w-full h-auto transform group-hover:scale-105 transition duration-300 ease-in-out shadow-md mt-16">

                {{-- Ornamen Bulatan --}}
                <div class="absolute -top-5 -left-5 w-20 h-20 bg-blue-300/30 rounded-full blur-xl"></div>
                <div class="absolute bottom-2 right-2 w-14 h-14 bg-blue-200/40 rounded-full blur-md"></div>

                {{-- Emoji --}}
                <div class="absolute top-2 right-2 text-4xl animate-bounce">🎓</div>
            </div>

            {{-- KANAN: DESKRIPSI --}}
            <div>
                <h2 class="text-3xl font-extrabold text-blue-800 mb-4 drop-shadow">
                    Halo Mahasiswa 👋
                </h2>

                <p class="text-gray-700 text-base mb-6 leading-relaxed text-justify">
                    Aplikasi ini hadir sebagai solusi simpel dan cerdas untuk kamu yang butuh ruangan untuk kegiatan akademik maupun non-akademik. Mulai dari diskusi kelompok, seminar/workshop mini, hingga rapat mendadak bareng dosen atau teman-teman organisasi, semua bisa kamu atur lewat sistem ini tanpa ribet! 📚
                </p>

                {{-- Quotes --}}
                <blockquote class="italic text-sm text-gray-500 bg-blue-50 px-4 py-2 rounded-md mb-6 border-l-4 border-blue-400">
                    “Belajar itu berat... Tapi rebutan ruangan lebih berat.” 😅
                </blockquote>

                <h4 class="text-xl font-semibold mb-3 text-blue-700">Syarat Peminjaman:</h4>
                <ul class="space-y-2 text-gray-700">
                    @foreach ([ 
                        'Mahasiswa aktif STT-NF',
                        'Peminjaman minimal H-1 sebelum penggunaan',
                        'Data harus lengkap dan benar',
                        'Ruangan tidak sedang digunakan'
                    ] as $syarat)
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-500 mt-1" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ $syarat }}
                    </li>
                    @endforeach
                </ul>

                {{-- Tombol ke Halaman Ruangan --}}
                <div class="mt-6">
                    <a href="{{ route('ruangan.index') }}"
                       class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white px-6 py-2 rounded-xl text-sm font-semibold shadow-md hover:from-blue-600 hover:to-blue-800 transition-all duration-300">
                        🚀 Booking Sekarang →
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
