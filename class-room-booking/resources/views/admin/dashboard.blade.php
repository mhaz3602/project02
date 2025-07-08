<x-layouts.app title="Dashboard Admin">
    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-purple-100 p-10">

        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 items-center bg-white/80 p-12 rounded-3xl shadow-2xl backdrop-blur-md border border-purple-200 relative overflow-hidden">

            {{-- Ornamen Blur --}}
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-purple-300/20 rounded-full blur-3xl z-0"></div>
            <div class="absolute bottom-0 -right-24 w-60 h-60 bg-indigo-400/20 rounded-full blur-2xl z-0"></div>

            {{-- Avatar Admin --}}
            <div class="relative z-10 flex justify-center">
                <img src="https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg" 
                     alt="Admin Avatar"
                     class="w-32 h-32 rounded-full ring-4 ring-purple-400 shadow-xl mb-6 animate-pulse" />
            </div>

            {{-- Konten Teks --}}
            <div class="z-10 space-y-6">
                <h1 class="text-4xl font-bold text-purple-800 drop-shadow">
                    Halo Admin! 🚀
                </h1>

                <p class="text-zinc-700 text-base leading-relaxed">
                    Selamat datang di <span class="font-semibold text-purple-700">Dashboard Admin</span>.  
                    Dari sini Anda bisa melihat statistik, memvalidasi peminjaman, dan mengelola ruangan kampus.
                </p>

                {{-- Blok Quote --}}
                <div class="bg-purple-50 border-l-4 border-purple-400 px-5 py-4 rounded-md shadow-inner text-sm italic text-purple-800">
                    "Ketertiban adalah cerminan kepemimpinan."
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
