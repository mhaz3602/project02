<x-layouts.app title="Validasi Peminjaman">
    <div class="p-6 max-w-7xl mx-auto">
        <h2 class="text-3xl font-bold text-blue-700 dark:text-white mb-6">📋 Validasi Peminjaman Ruangan</h2>

        @if (session('success'))
            <div class="bg-emerald-100 text-emerald-700 px-4 py-3 rounded-lg mb-4 shadow dark:bg-emerald-900 dark:text-emerald-200">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto rounded-xl shadow-md bg-white dark:bg-zinc-800">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700 text-sm">
                <thead class="bg-gradient-to-r from-blue-600 to-blue-400 text-white uppercase">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">NIM</th>
                        <th class="px-4 py-3 hidden xl:table-cell">No. Telp</th>
                        <th class="px-4 py-3">Ruangan</th>
                        <th class="px-4 py-3 hidden md:table-cell">Tanggal</th>
                        <th class="px-4 py-3 hidden md:table-cell">Jam</th>
                        <th class="px-4 py-3 hidden lg:table-cell">Keperluan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-zinc-700">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-blue-50 dark:hover:bg-zinc-700 transition">
                            <td class="px-4 py-2 font-semibold text-gray-800 dark:text-white">{{ $booking->nama }}</td>
                            <td class="px-4 py-2 text-gray-600 dark:text-zinc-300">{{ $booking->nim }}</td>
                            <td class="px-4 py-2 text-gray-600 dark:text-zinc-300 hidden xl:table-cell">{{ $booking->no_telp }}</td>
                            <td class="px-4 py-2 text-gray-600 dark:text-zinc-300">{{ $booking->ruangan->nama }}</td>
                            <td class="px-4 py-2 hidden md:table-cell text-gray-600 dark:text-zinc-300">{{ $booking->tanggal }}</td>
                            <td class="px-4 py-2 hidden md:table-cell text-gray-600 dark:text-zinc-300">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</td>
                            <td class="px-4 py-2 hidden lg:table-cell text-gray-600 dark:text-zinc-300">{{ $booking->keperluan }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                    {{
                                        $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' :
                                        ($booking->status === 'disetujui' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' :
                                        ($booking->status === 'ditolak' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200' :
                                        ($booking->status === 'selesai' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' :
                                        'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-white')))
                                    }}">
                                    {{
                                        $booking->status === 'pending' ? '⏳ Pending' :
                                        ($booking->status === 'disetujui' ? '✅ Disetujui' :
                                        ($booking->status === 'ditolak' ? '❌ Ditolak' :
                                        ($booking->status === 'selesai' ? '📦 Selesai' : '🚫 Batal')))
                                    }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center space-y-1 md:space-x-2">
                                @if ($booking->status === 'pending')
                                    <form action="{{ route('booking.setujui', $booking->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded shadow text-xs md:text-sm w-full md:w-auto">
                                            ✅ Setujui
                                        </button>
                                    </form>
                                    <form action="{{ route('booking.tolak', $booking->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded shadow text-xs md:text-sm w-full md:w-auto">
                                            ❌ Tolak
                                        </button>
                                    </form>
                                @elseif ($booking->status === 'disetujui')
                                    <form action="{{ route('booking.selesai', $booking->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded shadow text-xs md:text-sm w-full md:w-auto">
                                            📦 Selesai
                                        </button>
                                    </form>
                                    <form action="{{ route('booking.batal', $booking->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1 rounded shadow text-xs md:text-sm w-full md:w-auto">
                                            🚫 Batal
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-500 dark:text-gray-400 italic">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-6 text-gray-500 dark:text-gray-400">Tidak ada booking pending</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
