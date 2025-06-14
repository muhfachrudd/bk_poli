<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JanjiPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\DetailPeriksa;

class JanjiPeriksaController extends Controller
{
    // Daftar janji periksa untuk dokter yang sedang login
    public function index()
    {
        $dokterId = Auth::user()->id;
        $janjiPeriksas = JanjiPeriksa::with(['jadwalPeriksa', 'pasien'])
            ->whereHas('jadwalPeriksa', function ($q) use ($dokterId) {
                $q->where('id_dokter', $dokterId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        return view('dokter.janji-periksa.index', compact('janjiPeriksas'));
    }

    // Form input hasil periksa
    public function periksaForm($id)
    {
        $janji = JanjiPeriksa::with(['jadwalPeriksa', 'pasien'])->findOrFail($id);
        $obats = Obat::all();
        return view('dokter.janji-periksa.periksa', compact('janji', 'obats'));
    }

    // Simpan hasil periksa
    public function simpanPeriksa(Request $request, $id)
    {
        $request->validate([
            'hasil' => 'required',
            'biaya' => 'required|numeric',
            'obat' => 'array',
        ]);
        $janji = JanjiPeriksa::findOrFail($id);
        $periksa = Periksa::create([
            'id_janji_periksa' => $janji->id,
            'tgl_periksa' => now(),
            'catatan' => $request->hasil,
            'biaya_periksa' => $request->biaya,
        ]);
        if ($request->has('obat')) {
            foreach ($request->obat as $id_obat) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $id_obat,
                ]);
            }
        }
        return redirect()->route('dokter.janji-periksa.index')->with('status', 'periksa-selesai');
    }
}
