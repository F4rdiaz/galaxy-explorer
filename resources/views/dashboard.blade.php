@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white p-6">
    <h1 class="text-3xl font-bold mb-6">🌌 Dashboard Galaxy Explorer</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
        <div class="bg-indigo-700 p-5 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold">Total Misi</h2>
            <p class="text-3xl font-bold mt-2">{{ $jumlahMisi }}</p>
        </div>
        <div class="bg-blue-600 p-5 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold">Total Planet</h2>
            <p class="text-3xl font-bold mt-2">{{ $jumlahPlanet }}</p>
        </div>
        <div class="bg-green-600 p-5 rounded-lg shadow-lg">
            <h2 class="text-lg font-semibold">Total Astronot</h2>
            <p class="text-3xl font-bold mt-2">{{ $jumlahAstronot }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gray-800 p-5 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">📊 Status Misi</h2>
            <canvas id="statusChart" height="200"></canvas>
        </div>

        <div class="bg-gray-800 p-5 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">🪐 Misi per Planet</h2>
            <canvas id="planetChart" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Belum', 'Sedang', 'Selesai'],
            datasets: [{
                label: 'Status Misi',
                data: {!! json_encode($jumlahPerStatus) !!},
                backgroundColor: ['#f87171', '#facc15', '#34d399'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: { legend: { labels: { color: '#fff' } } }
        }
    });

    const planetCtx = document.getElementById('planetChart').getContext('2d');
    new Chart(planetCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelUkuran) !!},
            datasets: [{
                label: 'Jumlah Planet',
                data: {!! json_encode($ukuranPlanet) !!},
                backgroundColor: '#60a5fa'
            }]
        },
        options: {
            scales: {
                x: { ticks: { color: '#fff' } },
                y: { ticks: { color: '#fff' }, beginAtZero: true }
            },
            plugins: {
                legend: { labels: { color: '#fff' } }
            }
        }
    });
</script>
@endsection
