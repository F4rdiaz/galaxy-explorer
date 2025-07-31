@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white shadow-lg rounded-xl p-8">
    <h2 class="text-3xl font-bold mb-6 text-blue-400 text-center">🪐 Detail Planet</h2>

    <div class="space-y-6">
        <div class="flex items-center">
            <span class="w-48 font-semibold text-blue-200">🌍 Nama:</span>
            <span class="text-lg">{{ $planet->nama }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-48 font-semibold text-blue-200">📏 Ukuran:</span>
            <span class="text-lg">{{ $planet->ukuran }}</span>
        </div>

        <div class="flex items-center">
            <span class="w-48 font-semibold text-blue-200">🌌 Jarak Antar Planet:</span>
            <span class="text-lg">{{ $planet->jarak }}</span>
        </div>

        @if ($planet->gambar)
            <div>
                <span class="font-semibold text-blue-200">🖼️ Gambar Planet:</span><br>
                <img src="{{ asset('storage/' . $planet->gambar) }}" alt="{{ $planet->nama }}" class="w-48 mt-3 border rounded shadow-md">
            </div>
        @endif
    </div>

    <div class="mt-8 text-right">
        <a href="{{ route('planets.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition duration-200">
            🔙 Kembali ke Daftar
        </a>
    </div>
</div>
@endsection
