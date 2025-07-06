<x-layouts.app title="Riwayat Booking">
    <div class="p-6 space-y-6 bg-white min-h-screen">
        <h1 class="text-2xl font-bold text-blue-700 mb-6">Riwayat Booking Ruangan</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse text-sm">
                <thead class="bg-blue-100 text-blue-700">
                    <tr>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Nama Ruangan</th>
                        <th class="p-3 text-left">Jam</th>
                        <th class="p-3 text-left">Keperluan</th>
                        <th class="p-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($riwayat as $r)
                        <tr>
                            <td class="p-3">{{ \Carbon\Carbon::parse($r->tanggal)->format('d M Y') }}</td>
                            <td class="p-3">{{ $r->ruangan->nama ?? '-' }}</td>
                            <td class="p-3">{{ $r->jam_mulai }} - {{ $r->jam_selesai }}</td>
                            <td class="p-3">{{ $r->keperluan }}</td>
                            <td class="p-3">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                    @if($r->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($r->status == 'disetujui') bg-green-100 text-green-700
                                    @elseif($r->status == 'dibatalkan') bg-red-100 text-red-700
                                    @elseif($r->status == 'selesai') bg-blue-100 text-blue-700
                                    @endif
                                ">
                                    {{ ucfirst($r->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
