@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white shadow-lg rounded-xl p-8">
    <h2 class="text-3xl font-bold mb-6 text-center text-yellow-400">📝 Edit Planet</h2>

    <form action="{{ route('planets.update', $planet->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold text-yellow-300 mb-1">🌍 Nama Planet</label>
            <input type="text" name="nama" value="{{ old('nama', $planet->nama) }}" 
                   class="w-full rounded-md bg-gray-100 text-gray-800 p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-yellow-300 mb-1">📏 Ukuran</label>
            <input type="text" name="ukuran" value="{{ old('ukuran', $planet->ukuran) }}" 
                   class="w-full rounded-md bg-gray-100 text-gray-800 p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-yellow-300 mb-1">🌌 Jarak Antar Planet</label>
            <input type="text" name="jarak" value="{{ old('jarak', $planet->jarak) }}" 
                   class="w-full rounded-md bg-gray-100 text-gray-800 p-3 focus:outline-none focus:ring-2 focus:ring-yellow-400" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-yellow-300 mb-1">🖼️ Gambar Planet <span class="text-gray-400">(Opsional)</span></label>
            <input type="file" name="gambar" accept="image/*"
                   class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
            
            @if($planet->gambar)
                <div class="mt-4">
                    <span class="text-sm text-gray-400">Gambar saat ini:</span>
                    <img src="{{ asset('storage/' . $planet->gambar) }}" class="w-32 mt-2 border rounded shadow-md" alt="Gambar planet">
                </div>
            @endif
        </div>

        <div class="text-right pt-4">
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg font-semibold transition duration-200">
                🔄 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
