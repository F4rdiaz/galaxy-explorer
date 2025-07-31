@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-6">
    <div class="max-w-4xl mx-auto bg-gray-800 text-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-6">🚀 Detail Misi: {{ $mission->nama_misi }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div><span class="font-semibold">Nama Misi:</span> {{ $mission->nama_misi }}</div>
            <div><span class="font-semibold">Tahun Peluncuran:</span> {{ $mission->tahun_peluncuran }}</div>
            <div><span class="font-semibold">Tahun Kembali:</span> {{ $mission->tahun_kembali ?? '-' }}</div>
            <div><span class="font-semibold">Tujuan:</span> {{ $mission->tujuan }}</div>
            <div><span class="font-semibold">Status:</span> {{ ucfirst($mission->status) }}</div>
            <div><span class="font-semibold">Waktu Laporan:</span> 
                {{ \Carbon\Carbon::parse($mission->waktu_laporan)->format('d M Y H:i') }}
            </div>

            <div class="md:col-span-2">
                <span class="font-semibold">Keterangan:</span><br>
                <p class="mt-1 text-gray-300">{{ $mission->keterangan ?? '-' }}</p>
            </div>

            <div class="md:col-span-2">
                <span class="font-semibold">Astronot:</span><br>
                @if(is_array($mission->astronot))
                    <ul class="list-disc list-inside mt-1 text-gray-300">
                        @foreach($mission->astronot as $astronot)
                            <li>{{ $astronot }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="mt-1 text-gray-300">Data tidak tersedia.</p>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('missions.index') }}" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded text-white">
                ← Kembali ke Daftar Misi
            </a>
        </div>
    </div>
</div>
@endsection
