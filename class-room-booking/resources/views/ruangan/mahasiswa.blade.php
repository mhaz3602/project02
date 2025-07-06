@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">
        Daftar Ruangan yang Bisa Di-booking
    </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach($ruangan as $r)
        <div class="bg-white dark:bg-zinc-700 rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">
            <img src="{{ asset('storage/ruangan/' . ($r->foto ?? 'default.jpg')) }}"
                 alt="{{ $r->nama }}"
                 class="w-full h-48 object-cover rounded-t-xl">

            <div class="p-4 text-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                    {{ $r->nama }}
                </h2>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
