<x-layouts.app title="Riwayat Peminjaman">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Riwayat Peminjaman Ruangan</h2>

        @if(session('success'))
            <div class="p-3 mb-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
        @endif

        @if($bookings->isEmpty())
            <p>Belum ada peminjaman ruangan.</p>
        @else
            <table class="w-full table-auto border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1">Ruangan</th>
                        <th class="border px-2 py-1">Tanggal</th>
                        <th class="border px-2 py-1">Waktu</th>
                        <th class="border px-2 py-1">Keperluan</th>
                        <th class="border px-2 py-1">Status</th>
                        <th class="border px-2 py-1">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="border px-2 py-1">{{ $booking->ruangan->nama }}</td>
                            <td class="border px-2 py-1">{{ $booking->tanggal }}</td>
                            <td class="border px-2 py-1">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                            <td class="border px-2 py-1">{{ $booking->keperluan }}</td>
                            <td class="border px-2 py-1 capitalize">{{ $booking->status }}</td>
                            <td class="border px-2 py-1 space-x-1">
                                <a href="{{ route('booking.edit', $booking->id) }}" class="text-blue-600">Edit</a>
                                <form method="POST" action="{{ route('booking.destroy', $booking->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600" onclick="return confirm('Yakin batal?')">Batal</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layouts.app>