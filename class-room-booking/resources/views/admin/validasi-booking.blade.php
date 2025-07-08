<x-layouts.app title="Validasi Peminjaman">
    <div class="p-6 max-w-7xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Validasi Peminjaman Ruangan</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-xl overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 text-left">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Ruangan</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Jam</th>
                        <th class="px-4 py-3">Keperluan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $booking->nama }}</td>
                            <td class="px-4 py-2">{{ $booking->ruangan->nama }}</td>
                            <td class="px-4 py-2">{{ $booking->tanggal }}</td>
                            <td class="px-4 py-2">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                            <td class="px-4 py-2">{{ $booking->keperluan }}</td>
                            <td class="px-4 py-2 capitalize">{{ $booking->status }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                @if ($booking->status === 'pending')
                                    <form action="{{ route('booking.setujui', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                            Setujui
                                        </button>
                                    </form>

                                    <form action="{{ route('booking.tolak', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                            Tolak
                                        </button>
                                    </form>
                                @elseif ($booking->status === 'disetujui')
                                    <form action="{{ route('booking.selesai', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                                            Selesai
                                        </button>
                                    </form>

                                    <form action="{{ route('booking.batal', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">
                                            Batal
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 italic">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada booking pending</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
