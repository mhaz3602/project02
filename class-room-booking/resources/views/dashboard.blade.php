<x-layouts.app :title="'Dashboard'">
    <div class="p-6 space-y-6">
        <h2 class="text-xl font-semibold">Booking Ruangan</h2>

        @if(session('success'))
            <div class="p-3 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="p-3 bg-red-100 text-red-800 rounded-lg">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Ruangan</label>
                <select name="id_ruangan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- Pilih Ruangan --</option>
                    {{-- @foreach($ruangan as $r)
                        <option value="{{ $r->id }}">{{ $r->nama }} ({{ $r->kapasitas }} org)</option>
                    @endforeach --}}
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Keperluan</label>
                <input type="text" name="keperluan" placeholder="Contoh: Rapat, Belajar Kelompok"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <div>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md
                               font-semibold text-white hover:bg-blue-700 transition">
                    Booking Sekarang
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
