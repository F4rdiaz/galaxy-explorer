@extends('layouts.app')

@section('content')
<div class="text-white">
    <h1 class="text-3xl font-bold mb-6">🪐 Daftar Planet</h1>

    <a href="{{ route('planets.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-6 inline-block">
        + Tambah Planet
    </a>

    @if(session('success'))
        <div class="bg-green-800 border border-green-400 text-white px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-gray-900 rounded shadow">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Ukuran</th>
                    <th class="p-3">Jarak</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planets as $planet)
                <tr class="border-t border-gray-700 hover:bg-gray-800">
                    <td class="p-3">{{ $planet->nama }}</td>
                    <td class="p-3">{{ $planet->ukuran }}</td>
                    <td class="p-3">{{ $planet->jarak }}</td>
                    <td class="p-3 space-y-1 sm:space-x-2 sm:space-y-0 flex flex-col sm:flex-row">
                        <a href="{{ route('planets.show', $planet->id) }}" class="text-blue-400 hover:underline">Detail</a>
                        <a href="{{ route('planets.edit', $planet->id) }}" class="text-yellow-400 hover:underline">Edit</a>
                        <form action="{{ route('planets.destroy', $planet->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
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
</div>
@endsection
