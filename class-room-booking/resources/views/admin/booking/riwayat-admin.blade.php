<x-layouts.app title="Riwayat Peminjaman (Admin)">
    <div class="p-6">
        <h2 class="text-3xl font-bold text-center text-blue-800 mb-2">📜 Riwayat Peminjaman (Admin)</h2>
        <p class="text-center text-sm text-gray-500 mb-6">Data semua peminjaman ruangan oleh seluruh pengguna</p>

        @if(session('success'))
            <div class="p-3 mb-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-sm text-center">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-2">
                <label for="tanggal" class="text-sm text-gray-600">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}"
                    class="border rounded px-2 py-1 text-sm shadow-sm" />
            </div>

            <div class="flex items-center gap-2">
                <label for="status" class="text-sm text-gray-600">Status:</label>
                <select name="status" id="status" class="border rounded px-2 py-1 text-sm shadow-sm">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>

            <button type="submit"
                class="bg-blue-600 text-white px-4 py-1.5 rounded hover:bg-blue-700 text-sm shadow-sm">
                🔍 Filter
            </button>

            <a href="{{ route('admin.booking.riwayat') }}" class="text-sm text-blue-600 underline ml-auto">
                🔄 Reset
            </a>
        </form>

        @if($riwayat->isEmpty())
            <div class="text-gray-500 italic text-center">Belum ada peminjaman ruangan.</div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-gray-200">
                <table class="w-full text-sm text-left table-auto">
                    <thead class="bg-gradient-to-r from-blue-50 to-blue-100 text-blue-800 font-semibold">
                        <tr>
                            <th class="px-4 py-3 border-b text-center">No.</th>
                            <th class="px-4 py-3 border-b">Nama Peminjam</th>
                            <th class="px-4 py-3 border-b">Ruangan</th>
                            <th class="px-4 py-3 border-b">Tanggal</th>
                            <th class="px-4 py-3 border-b">Waktu</th>
                            <th class="px-4 py-3 border-b">Keperluan</th>
                            <th class="px-4 py-3 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($riwayat as $index => $booking)
                            <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-gray-100 transition">
                                <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                <td class="px-4 py-2">{{ $booking->nama }}</td>
                                <td class="px-4 py-2">{{ $booking->ruangan->nama }}</td>
                                <td class="px-4 py-2">{{ $booking->tanggal }}</td>
                                <td class="px-4 py-2">
                                    {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                                </td>
                                <td class="px-4 py-2">{{ $booking->keperluan }}</td>
                                <td class="px-4 py-2">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'disetujui' => 'bg-green-100 text-green-800',
                                            'ditolak' => 'bg-red-100 text-red-800',
                                            'batal' => 'bg-gray-200 text-gray-600',
                                            'selesai' => 'bg-blue-100 text-blue-800',
                                        ];
                                        $statusClass = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-layouts.app>
