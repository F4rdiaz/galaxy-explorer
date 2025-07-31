<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Mission::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_misi', 'like', "%{$search}%")
                  ->orWhere('tujuan', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('sort')) {
            $query->orderBy('tahun_peluncuran', $request->sort === 'asc' ? 'asc' : 'desc');
        }

        $missions = $query->get();

        return view('missions.index', compact('missions'));
    }

    public function create()
    {
        return view('missions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_misi' => 'required|string|max:255',
            'tahun_peluncuran' => 'required|integer',
            'tahun_kembali' => 'nullable|integer',
            'tujuan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'astronot' => 'required|string',
            'status' => 'required|in:belum,sedang,selesai',
            'waktu_laporan' => 'required|date',
        ]);

        Mission::create([
            'nama_misi' => $request->nama_misi,
            'tahun_peluncuran' => $request->tahun_peluncuran,
            'tahun_kembali' => $request->tahun_kembali,
            'tujuan' => $request->tujuan,
            'keterangan' => $request->keterangan,
            'astronot' => array_map('trim', explode(',', $request->astronot)),
            'status' => $request->status,
            'waktu_laporan' => $request->waktu_laporan,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('missions.index')->with('success', 'Misi berhasil ditambahkan.');
    }

    public function show(Mission $mission)
    {
        return view('missions.show', compact('mission'));
    }

    public function edit(Mission $mission)
    {
        return view('missions.edit', compact('mission'));
    }

    public function update(Request $request, Mission $mission)
    {
        $request->validate([
            'nama_misi' => 'required|string|max:255',
            'tahun_peluncuran' => 'required|integer',
            'tahun_kembali' => 'nullable|integer',
            'tujuan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'astronot' => 'required|string',
            'status' => 'required|in:belum,sedang,selesai',
            'waktu_laporan' => 'required|date',
        ]);

        $mission->update([
            'nama_misi' => $request->nama_misi,
            'tahun_peluncuran' => $request->tahun_peluncuran,
            'tahun_kembali' => $request->tahun_kembali,
            'tujuan' => $request->tujuan,
            'keterangan' => $request->keterangan,
            'astronot' => array_map('trim', explode(',', $request->astronot)),
            'status' => $request->status,
            'waktu_laporan' => $request->waktu_laporan,
        ]);

        return redirect()->route('missions.index')->with('success', 'Misi berhasil diupdate.');
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();
        return redirect()->route('missions.index')->with('success', 'Misi berhasil dihapus.');
    }

    public function exportPdf()
    {
        $missions = Mission::all();

        $pdf = Pdf::loadView('missions.pdf', compact('missions'))->setPaper('a4', 'landscape');
        return $pdf->download('data_misi_antariksa.pdf');
    }
}
