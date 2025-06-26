@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Booking</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ruangan</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Keperluan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $b->ruangan->nama ?? '-' }}</td>
                <td>{{ $b->tanggal }}</td>
                <td>{{ $b->jam_mulai }} - {{ $b->jam_selesai }}</td>
                <td>{{ $b->keperluan }}</td>
                <td>{{ ucfirst($b->status) }}</td>
                <td>
                    @if($b->status != 'dibatalkan')
                        <a href="{{ route('booking.edit', $b->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('booking.destroy', $b->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin batal?')">Batal</button>
                        </form>
                    @else
                        <em>-</em>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
