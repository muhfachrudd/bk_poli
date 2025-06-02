<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\jadwalPeriksa;
use App\Models\JanjiPeriksa;

class JanjiPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pasien = User::where('role', 'pasien')->first();
        $jadwal = jadwalPeriksa::first();

        $janjis = [
            [
                'id_pasien' => $pasien->id,
                'id_jadwal_periksa' => $jadwal->id,
                'keluhan' => 'Sakit kepala',
                'no_antrian' => '1',
            ],
            [
                'id_pasien' => $pasien->id,
                'id_jadwal_periksa' => $jadwal->id,
                'keluhan' => 'Demam tinggi',
                'no_antrian' => '2',
            ],
        ];

        foreach ($janjis as $janji) {
            JanjiPeriksa::create($janji);
        }
    }
}
