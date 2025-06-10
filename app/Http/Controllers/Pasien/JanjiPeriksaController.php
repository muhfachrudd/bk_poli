<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\JanjiPeriksa;
use App\Models\User;

class JanjiPeriksaController extends Controller
{
    public function index()
    {
        $no_rm = Auth::user()->no_rm;
        $janjiPeriksas = JanjiPeriksa::with([
            'jadwalPeriksa.dokter',
            'pasien'
        ])
            ->where('id_pasien', Auth::user()->id)
            ->orderBy('created_at', 'asc') 
            ->get();

        return view('pasien.janji-periksa.index')->with([
            'no_rm' => $no_rm,
            'janjiPeriksas' => $janjiPeriksas,
        ]);
    }

    public function create()
    {
        $no_rm = Auth::user()->no_rm;
        $dokters = User::with([
            'jadwalPeriksas' => function ($query) {
                $query->where('status', true);
            },
        ])
            ->where('role', 'dokter')
            ->get();

        return view('pasien.janji-periksa.create', [
            'no_rm' => $no_rm,
            'dokters' => $dokters,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required',
        ]);

        $jumlahJanji = JanjiPeriksa::where('id_jadwal_periksa', $validatedData['id_jadwal_periksa'])->count();
        $noAntrian = $jumlahJanji + 1;

        JanjiPeriksa::create([
            'id_pasien' => Auth::user()->id,
            'id_jadwal_periksa' => $validatedData['id_jadwal_periksa'],
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return Redirect::route('pasien.janji-periksa.index')->with('status', 'janji-periksa-created');
    }

    public function edit($id)
    {
        $janji = JanjiPeriksa::findOrFail($id);
        $dokters = User::with([
            'jadwalPeriksas' => function ($query) {
                $query->where('status', true);
            },
        ])
            ->where('role', 'dokter')
            ->get();
            
        return view('pasien.janji-periksa.edit', compact('janji', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jadwal_periksa' => 'required|exists:jadwal_periksas,id',
            'keluhan' => 'required',
        ]);
        $janji = JanjiPeriksa::findOrFail($id);
        $janji->update([
            'id_jadwal_periksa' => $request->id_jadwal_periksa,
            'keluhan' => $request->keluhan,
        ]);
        return redirect()->route('pasien.janji-periksa.index')->with('status', 'janji-updated');
    }

    public function destroy($id)
    {
        $janji = JanjiPeriksa::findOrFail($id);
        $janji->delete();
        return redirect()->route('pasien.janji-periksa.index')->with('status', 'janji-deleted');
    }
}
