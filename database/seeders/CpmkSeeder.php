<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cpmk;
use Carbon\Carbon;

class CpmkSeeder extends Seeder
{
    public function run()
    {
        Cpmk::create([
            'id' => 1,
            'name' => 'CPMK-01',
            'deskripsi' => 'ini adalah cpmk 01',
            'skor_maks' => 87.3,
            'created_at' => Carbon::create('2024', '10', '14', '08', '01', '53'),
            'updated_at' => Carbon::create('2024', '10', '14', '08', '02', '01'),
        ]);

        Cpmk::create([
            'id' => 2,
            'name' => 'CPMK-02',
            'deskripsi' => 'ini adalah cpmk 02',
            'skor_maks' => 78.5,
            'created_at' => Carbon::create('2024', '10', '14', '08', '02', '19'),
            'updated_at' => Carbon::create('2024', '10', '14', '08', '02', '19'),
        ]);

        Cpmk::create([
            'id' => 3,
            'name' => 'CPMK-03',
            'deskripsi' => 'ini adalah cpmk 03 masbrooo',
            'skor_maks' => 87.9,
            'created_at' => Carbon::create('2024', '10', '14', '08', '02', '33'),
            'updated_at' => Carbon::create('2024', '10', '14', '18', '20', '17'),
        ]);
    }
}