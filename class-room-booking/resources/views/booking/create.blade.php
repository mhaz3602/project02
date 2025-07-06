<x-layouts.app title="Booking Ruangan">
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-md space-y-6">

        @if(isset($ruanganTerpilih))
            <div class="flex flex-col md:flex-row gap-6 items-start">
                <img src="{{ asset('images/ruangan/' . $ruanganTerpilih->foto) }}" alt="{{ $ruanganTerpilih->nama }}"
                     class="w-full md:w-64 h-40 object-cover rounded-lg shadow">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-blue-700">{{ $ruanganTerpilih->nama }}</h2>
                    <p class="text-gray-600">Kapasitas: {{ $ruanganTerpilih->kapasitas }} orang</p>
                    <p class="text-gray-600">Lokasi: {{ $ruanganTerpilih->lokasi }}</p>
                    @if($ruanganTerpilih->fasilitas)
                        <p class="text-gray-600">Fasilitas: {{ $ruanganTerpilih->fasilitas }}</p>
                    @endif
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="id_ruangan" value="{{ $ruanganTerpilih->id ?? '' }}">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri -->
                <div class="space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="nama" id="nama" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" id="nim" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="no_telp" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                        <input type="text" name="keperluan" id="keperluan" placeholder="Contoh: Rapat, Diskusi, Seminar" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="space-y-4">
                    <div>
                        <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" required
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>

            <div class="text-end pt-4">
                <button type="submit"
                        class="bg-blue-600 text-white font-semibold px-6 py-2 rounded hover:bg-blue-700 transition">
                    Booking Sekarang
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
