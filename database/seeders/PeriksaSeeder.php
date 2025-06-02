<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Periksa;
use App\Models\JanjiPeriksa;

class PeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $janji = JanjiPeriksa::first();

        $data = [
            [
                'id_janji_periksa' => $janji->id,
                'tgl_periksa' => now(),
                'catatan' => 'Pasien dalam kondisi baik',
                'biaya_periksa' => 50000,
            ],
        ];

        foreach ($data as $item) {
            Periksa::create($item);
        }
    }
}
