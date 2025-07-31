<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PlanetController;
use App\Models\Mission;
use App\Models\Planet;

// Redirect root (/) langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard - Menampilkan grafik statistik misi dan planet
Route::get('/dashboard', function () {
    // --- Donut Chart: Status Misi ---
    $jumlahPerStatus = [
        'belum' => Mission::where('status', 'belum')->count(),
        'sedang' => Mission::where('status', 'sedang')->count(),
        'selesai' => Mission::where('status', 'selesai')->count(),
    ];

    // --- Bar Chart: Ukuran Planet ---
    $planetUkuran = Planet::pluck('ukuran');
    $ukuranPlanet = [
        'kecil' => $planetUkuran->filter(fn($ukuran) => $ukuran < 5000)->count(),
        'sedang' => $planetUkuran->filter(fn($ukuran) => $ukuran >= 5000 && $ukuran <= 12000)->count(),
        'besar' => $planetUkuran->filter(fn($ukuran) => $ukuran > 12000)->count(),
    ];

    // --- Line Chart: Misi per Tahun ---
    $misiPerTahun = Mission::selectRaw('tahun_peluncuran, COUNT(*) as jumlah')
        ->groupBy('tahun_peluncuran')
        ->orderBy('tahun_peluncuran')
        ->get();

    // --- Total Data ---
    $jumlahMisi = Mission::count();
    $jumlahPlanet = Planet::count();

    // Kolom astronot wajib bertipe JSON/array (jika tidak, ini bisa error)
    $jumlahAstronot = Mission::pluck('astronot')
        ->flatten()
        ->unique()
        ->count();

    return view('dashboard', [
        // Grafik Donut
        'labelStatus' => array_keys($jumlahPerStatus),
        'jumlahPerStatus' => array_values($jumlahPerStatus),

        // Grafik Bar
        'labelUkuran' => array_keys($ukuranPlanet),
        'ukuranPlanet' => array_values($ukuranPlanet),

        // Grafik Line
        'misiPerTahunLabels' => $misiPerTahun->pluck('tahun_peluncuran')->toArray(),
        'misiPerTahunData' => $misiPerTahun->pluck('jumlah')->toArray(),

        // Statistik Atas
        'jumlahMisi' => $jumlahMisi,
        'jumlahPlanet' => $jumlahPlanet,
        'jumlahAstronot' => $jumlahAstronot,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

// Route khusus pengguna login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Misi dan Planet
    Route::resource('missions', MissionController::class);
    Route::resource('planets', PlanetController::class);
    Route::get('/missions/export/pdf', [MissionController::class, 'exportPdf'])->name('missions.exportPdf');
});

// Autentikasi (Laravel Breeze / Fortify)
require __DIR__.'/auth.php';
