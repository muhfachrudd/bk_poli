<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalPeriksaController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPeriksa::where('id_dokter', Auth::id())->get();
        return view('dokter.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        return view('dokter.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);
        JadwalPeriksa::create([
            'id_dokter' => Auth::id(),
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status' => false, // default nonaktif
        ]);
        return redirect()->route('dokter.jadwal.index')->with('status', 'jadwal-created');
    }

    public function edit($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        return view('dokter.jadwal.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);
        $jadwal = JadwalPeriksa::findOrFail($id);
        $jadwal->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
        ]);
        return redirect()->route('dokter.jadwal.index')->with('status', 'jadwal-updated');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('dokter.jadwal.index')->with('status', 'jadwal-deleted');
    }

    public function toggleStatus($id)
    {
        $jadwal = JadwalPeriksa::findOrFail($id);
        if (!$jadwal->status) {
            JadwalPeriksa::where('id_dokter', $jadwal->id_dokter)
                ->where('id', '!=', $jadwal->id)
                ->update(['status' => false]);
            $jadwal->status = true;
        } else {
            $jadwal->status = false;
        }
        $jadwal->save();
        return redirect()->route('dokter.jadwal.index')->with('status', 'jadwal-status-updated');
    }
}
