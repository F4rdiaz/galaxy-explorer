@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-6">
    <div class="max-w-3xl mx-auto bg-gray-800 text-white p-6 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-6">🛠️ Edit Misi: {{ $mission->nama_misi }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <strong>Ada beberapa kesalahan:</strong>
                <ul class="list-disc ml-6 mt-2">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('missions.update', $mission->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="nama_misi" class="block font-semibold mb-1">Nama Misi</label>
                    <input type="text" name="nama_misi" id="nama_misi" value="{{ old('nama_misi', $mission->nama_misi) }}" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                </div>

                <div>
                    <label for="tahun_peluncuran" class="block font-semibold mb-1">Tahun Peluncuran</label>
                    <input type="number" name="tahun_peluncuran" id="tahun_peluncuran" value="{{ old('tahun_peluncuran', $mission->tahun_peluncuran) }}" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                </div>

                <div>
                    <label for="tahun_kembali" class="block font-semibold mb-1">Tahun Kembali</label>
                    <input type="number" name="tahun_kembali" id="tahun_kembali" value="{{ old('tahun_kembali', $mission->tahun_kembali) }}" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                </div>

                <div>
                    <label for="tujuan" class="block font-semibold mb-1">Tujuan</label>
                    <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan', $mission->tujuan) }}" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                </div>

                <div>
                    <label for="status" class="block font-semibold mb-1">Status</label>
                    <select name="status" id="status" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                        <option value="belum" {{ old('status', $mission->status) == 'belum' ? 'selected' : '' }}>Belum</option>
                        <option value="sedang" {{ old('status', $mission->status) == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="selesai" {{ old('status', $mission->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div>
                    <label for="waktu_laporan" class="block font-semibold mb-1">Waktu Laporan</label>
                    <input type="datetime-local" name="waktu_laporan" id="waktu_laporan" value="{{ old('waktu_laporan', \Carbon\Carbon::parse($mission->waktu_laporan)->format('Y-m-d\TH:i')) }}" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                </div>

                <div class="md:col-span-2">
                    <label for="keterangan" class="block font-semibold mb-1">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" rows="4" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">{{ old('keterangan', $mission->keterangan) }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label for="astronot" class="block font-semibold mb-1">Nama Astronot (pisahkan dengan koma)</label>
                    <input type="text" name="astronot" id="astronot" value="{{ old('astronot', is_array($mission->astronot) ? implode(', ', $mission->astronot) : $mission->astronot) }}" class="w-full p-2 rounded bg-gray-700 text-white border border-gray-600">
                </div>
            </div>

            <div class="mt-6 flex justify-between">
                <a href="{{ route('missions.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">← Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
