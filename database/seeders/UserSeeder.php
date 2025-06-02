<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use phpDocumentor\Reflection\Types\Null_;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Doktor A',
                'email' => 'dokter@example.com',
                'password' => bcrypt('password'),
                'role' => 'dokter',
                'alamat' => 'Jl. Admin No. 1',
                'no_ktp' => '1234567890',
                'no_hp' => '081234567890',
                'no_rm' => null,
                'poli' => 'Umum',
            ],
            [
                'nama' => 'Pasien A',
                'email' => 'pasien@example.com',
                'password' => bcrypt('password'),
                'role' => 'pasien',
                'alamat' => 'Jl. Pasien No. 1',
                'no_ktp' => '0987654321',
                'no_hp' => '081098765432',
                'no_rm' => 'RM001',
                'poli' => null,
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
