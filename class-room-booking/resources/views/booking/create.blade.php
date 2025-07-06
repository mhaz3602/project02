<x-layouts.app title="Booking Ruangan">
    <div class="max-w-4xl mx-auto py-10 px-6">
        
        <!-- Judul Halaman -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-blue-700 mb-2">📅 Formulir Booking Ruangan</h1>
            <p class="text-gray-500 text-sm">Isi data berikut untuk meminjam ruangan sesuai kebutuhan kegiatanmu!</p>
        </div>

        <!-- Info Ruangan Terpilih -->
        @if(isset($ruanganTerpilih))
            <div class="flex flex-col md:flex-row gap-6 items-start bg-blue-50 border border-blue-200 p-5 rounded-xl shadow mb-8">
                <img src="{{ asset('images/ruangan/' . $ruanganTerpilih->foto) }}"
                     alt="{{ $ruanganTerpilih->nama }}"
                     class="w-full md:w-64 h-40 object-cover rounded-lg shadow">
                <div class="flex-1 space-y-1">
                    <h2 class="text-xl font-semibold text-blue-800">{{ $ruanganTerpilih->nama }}</h2>
                    <p class="text-sm text-gray-700">📍 {{ $ruanganTerpilih->lokasi }}</p>
                    <p class="text-sm text-gray-700">👥 Kapasitas: {{ $ruanganTerpilih->kapasitas }} orang</p>
                    @if($ruanganTerpilih->fasilitas)
                        <p class="text-sm text-gray-700">🛠️ Fasilitas: {{ $ruanganTerpilih->fasilitas }}</p>
                    @endif
                </div>
            </div>
        @endif

        <!-- Formulir Booking -->
        <form method="POST" action="{{ route('booking.store') }}"
              class="bg-white p-6 rounded-xl shadow-md space-y-6 border border-gray-100">
            @csrf
            <input type="hidden" name="id_ruangan" value="{{ $ruanganTerpilih->id ?? '' }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Mahasiswa -->
                <div class="space-y-4">
                    <x-form.input name="nama" label="Nama Lengkap" required />
                    <x-form.input name="nim" label="NIM" required />
                    <x-form.input name="no_telp" label="No. Telepon" required />
                    <x-form.input name="keperluan" label="Keperluan" placeholder="Contoh: Rapat, Seminar, Diskusi" required />
                </div>

                <!-- Jadwal -->
                <div class="space-y-4">
                    <x-form.input type="date" name="tanggal" label="Tanggal" required />
                    <x-form.input type="time" name="jam_mulai" label="Jam Mulai" required />
                    <x-form.input type="time" name="jam_selesai" label="Jam Selesai" required />
                </div>
            </div>

            <div class="text-end pt-4">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-700 transition shadow-sm">
                    🚀 Booking Sekarang
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
