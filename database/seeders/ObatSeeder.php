<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obats = [
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet',
                'harga' => 5000,
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul',
                'harga' => 15000,
            ],
            [
                'nama_obat' => 'Ibuprofen',
                'kemasan' => 'Sirup',
                'harga' => 10000,
            ],
            [
                'nama_obat' => 'Cetirizine',
                'kemasan' => 'Tablet',
                'harga' => 7000,
            ],
        ];
        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}
