<x-layouts.app title="Riwayat Booking Ruangan">
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow space-y-6">
        <h2 class="text-2xl font-bold text-blue-700">Riwayat Booking Anda</h2>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-white uppercase bg-blue-600">
                    <tr>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Nama Ruangan</th>
                        <th class="px-4 py-2">Jam</th>
                        <th class="px-4 py-2">Keperluan</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($booking as $b)
                        <tr>
                            <td class="px-4 py-2">{{ $b->tanggal }}</td>
                            <td class="px-4 py-2">{{ $b->ruangan->nama ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $b->jam_mulai }} - {{ $b->jam_selesai }}</td>
                            <td class="px-4 py-2">{{ $b->keperluan }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-2 py-1 rounded-full text-xs font-medium
                                    @if($b->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($b->status == 'disetujui') bg-green-100 text-green-700
                                    @elseif($b->status == 'dibatalkan') bg-red-100 text-red-700
                                    @else bg-gray-100 text-gray-700
                                    @endif">
                                    {{ ucfirst($b->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-400">Belum ada booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
