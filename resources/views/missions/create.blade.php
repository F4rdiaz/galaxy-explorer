@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-8">
    <div class="max-w-3xl mx-auto bg-gray-800 rounded-2xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-center text-indigo-400 mb-8">🚀 Tambah Misi Antariksa Baru</h2>

        {{-- TAMPILKAN ERROR VALIDASI --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-100 text-red-800 p-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('missions.store') }}" method="POST" onsubmit="return validateForm()">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold mb-1">🛰️ Nama Misi</label>
                    <input type="text" name="nama_misi" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white placeholder-gray-400" placeholder="Contoh: Voyager I" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">🚀 Tahun Peluncuran</label>
                        <input type="number" name="tahun_peluncuran" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white" min="1950" max="2100" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">🛬 Tahun Kembali <span class="text-gray-400 text-sm">(opsional)</span></label>
                        <input type="number" name="tahun_kembali" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white" min="1950" max="2100">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">🌌 Tujuan Misi</label>
                    <input type="text" name="tujuan" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white" placeholder="Contoh: Mars" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">📋 Keterangan</label>
                    <textarea name="keterangan" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white" rows="4" placeholder="Deskripsi misi..." required></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">🧍‍ Astronot yang Terlibat (pisahkan dengan koma)</label>
                    <input type="text" name="astronot" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white" placeholder="Contoh: Neil Armstrong, Buzz Aldrin" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold mb-1">📅 Waktu Laporan</label>
                        <input type="datetime-local" name="waktu_laporan" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">📌 Status Misi</label>
                        <select name="status" class="w-full rounded-md p-3 bg-gray-700 border border-gray-600 text-white" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="belum">Belum Dikerjakan</option>
                            <option value="sedang">Sedang Berlangsung</option>
                            <option value="selesai">Sudah Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 text-center">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200">
                        💾 Simpan Misi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function validateForm() {
        const tahunPeluncuran = parseInt(document.querySelector('[name="tahun_peluncuran"]').value);
        const tahunKembali = parseInt(document.querySelector('[name="tahun_kembali"]').value);
        if (tahunKembali && tahunKembali < tahunPeluncuran) {
            alert("Tahun kembali tidak boleh lebih awal dari tahun peluncuran.");
            return false;
        }
        return true;
    }
</script>
@endsection
