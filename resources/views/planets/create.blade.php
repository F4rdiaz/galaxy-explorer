@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-gradient-to-br from-indigo-100 to-white shadow-xl border border-indigo-200 rounded-2xl p-8 text-gray-800">
    <h2 class="text-3xl font-bold text-center text-indigo-700 mb-8 tracking-wide">🪐 Tambah Planet Baru</h2>

    <form action="{{ route('planets.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="planetForm">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-indigo-800 mb-1">🌍 Nama Planet</label>
            <input type="text" name="nama" class="w-full border border-indigo-300 rounded-md p-3 placeholder-indigo-400 text-gray-900" placeholder="Contoh: Mars" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-indigo-800 mb-1">📏 Ukuran</label>
            <input type="text" name="ukuran" class="w-full border border-indigo-300 rounded-md p-3 placeholder-indigo-400 text-gray-900" placeholder="Contoh: 6.779 km" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-indigo-800 mb-1">🌌 Jarak Antar Planet</label>
            <input type="text" name="jarak" class="w-full border border-indigo-300 rounded-md p-3 placeholder-indigo-400 text-gray-900" placeholder="Contoh: 225 juta km" required>
        </div>

        <div>
            <label class="block text-sm font-semibold text-indigo-800 mb-1">🖼️ Gambar Planet (Opsional)</label>
            <input type="file" name="gambar" class="w-full text-sm file:py-2 file:px-4 file:rounded-md file:bg-indigo-100 hover:file:bg-indigo-200 file:font-semibold" accept="image/*">
        </div>

        <div class="pt-4 text-center">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md">
                💾 Simpan Planet
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('planetForm').addEventListener('submit', function(e) {
        const nama = document.querySelector('input[name="nama"]');
        const ukuran = document.querySelector('input[name="ukuran"]');
        const jarak = document.querySelector('input[name="jarak"]');
        const numberPattern = /\d+/;

        if (!nama.value.trim() || !ukuran.value.trim() || !jarak.value.trim()) {
            alert('Semua field wajib diisi!');
            e.preventDefault();
        }

        if (!numberPattern.test(ukuran.value) || !numberPattern.test(jarak.value)) {
            alert('Ukuran dan jarak harus mengandung angka!');
            e.preventDefault();
        }
    });
</script>
@endsection
