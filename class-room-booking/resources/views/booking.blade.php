<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body>
    
<div class="container mt-4">
    <h3>Booking Ruangan</h3>
    <form method="POST" action="{{ route('booking.store') }}">
        @csrf
        <div class="mb-3">
            <label for="id_ruangan" class="form-label">Ruangan</label>
            <select name="id_ruangan" class="form-control" required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach($ruangan as $r)
                    <option value="{{ $r->id }}">{{ $r->nama }} ({{ $r->kapasitas }} org)</option>
                @endforeach 
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="keperluan" class="form-label">Keperluan</label>
            <input type="text" name="keperluan" class="form-control" placeholder="Contoh: Rapat, Belajar Kelompok" required>
        </div>
        <button type="submit" class="btn btn-primary">Booking Sekarang</button>
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>
</html>