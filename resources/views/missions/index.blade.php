@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6 text-white">📋 Daftar Misi Antariksa</h1>

    {{-- Form Pencarian dan Aksi --}}
    <form method="GET" action="{{ route('missions.index') }}" class="mb-4 flex flex-wrap gap-3">
        <input type="text" name="search" placeholder="Cari nama misi..." value="{{ request('search') }}"
            class="flex-1 min-w-[200px] px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500">

        <button type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded transition">
            🔍 Cari
        </button>

        <a href="{{ route('missions.index') }}"
            class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-4 py-2 rounded transition">
            ❌ Reset
        </a>

        <a href="{{ route('missions.exportPdf') }}"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded transition">
            📄 Export PDF
        </a>

        <a href="{{ route('missions.create') }}"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition">
            + Tambah Misi
        </a>
    </form>

    {{-- Tabel Responsif --}}
    @if ($missions->isEmpty())
        <p class="text-gray-300">Tidak ada misi ditemukan.</p>
    @else
        <div class="overflow-x-auto bg-gray-900 rounded-xl shadow-md">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-indigo-700 text-white">
                    <tr>
                        <th class="p-3 whitespace-nowrap">Nama</th>
                        <th class="p-3 whitespace-nowrap">Tahun</th>
                        <th class="p-3 whitespace-nowrap">Tujuan</th>
                        <th class="p-3 whitespace-nowrap">Status</th>
                        <th class="p-3 whitespace-nowrap">Waktu Laporan</th>
                        <th class="p-3 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($missions as $mission)
                        <tr class="border-t border-gray-700 hover:bg-gray-800">
                            <td class="p-3">{{ $mission->nama_misi }}</td>
                            <td class="p-3">{{ $mission->tahun_peluncuran }} - {{ $mission->tahun_kembali ?? '-' }}</td>
                            <td class="p-3">{{ $mission->tujuan }}</td>
                            <td class="p-3 capitalize">{{ $mission->status }}</td>
                            <td class="p-3">{{ \Carbon\Carbon::parse($mission->waktu_laporan)->format('d M Y H:i') }}</td>
                            <td class="p-3 space-y-1 sm:space-x-2 sm:space-y-0 flex flex-col sm:flex-row">
                                <a href="{{ route('missions.show', $mission) }}" class="text-blue-400 hover:underline">Detail</a>
                                <a href="{{ route('missions.edit', $mission) }}" class="text-yellow-400 hover:underline">Edit</a>
                                <form action="{{ route('missions.destroy', $mission) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
