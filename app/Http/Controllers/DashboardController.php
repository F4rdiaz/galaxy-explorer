<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Planet;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahMisi = Mission::count();
        $jumlahPlanet = Planet::count();

        // Ambil dan hitung total astronot unik dari semua misi
        $allAstronot = Mission::pluck('astronot')->flatten()->unique();
        $jumlahAstronot = $allAstronot->count();

        // Hitung misi berdasarkan status
        $statusBelum = Mission::where('status', 'belum')->count();
        $statusSedang = Mission::where('status', 'sedang')->count();
        $statusSelesai = Mission::where('status', 'selesai')->count();

        // Hitung jumlah misi per planet
        $namaPlanet = Planet::pluck('nama');
        $jumlahMisiPerPlanet = $namaPlanet->map(function ($nama) {
            return Mission::where('tujuan', $nama)->count();
        });

        return view('dashboard', compact(
            'jumlahMisi',
            'jumlahPlanet',
            'jumlahAstronot',
            'statusBelum',
            'statusSedang',
            'statusSelesai',
            'namaPlanet',
            'jumlahMisiPerPlanet'
        ));
    }
}
