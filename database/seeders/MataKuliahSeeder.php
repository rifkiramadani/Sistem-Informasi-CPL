<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mata_kuliah;
use Carbon\Carbon;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        Mata_kuliah::create([
            'id' => 1,
            'kode_matkul' => 'SI-4321',
            'name' => 'Bahasa Pemrograman',
            'semester_id' => 1,
            'created_at' => Carbon::create('2024', '10', '19', '07', '46', '50'),
            'updated_at' => Carbon::create('2024', '11', '17', '06', '43', '26'),
        ]);

        Mata_kuliah::create([
            'id' => 2,
            'kode_matkul' => 'SI-5678',
            'name' => 'Pengantar Basis Data',
            'semester_id' => 3,
            'created_at' => Carbon::create('2024', '10', '19', '07', '55', '58'),
            'updated_at' => Carbon::create('2024', '11', '17', '06', '43', '35'),
        ]);

        Mata_kuliah::create([
            'id' => 4,
            'kode_matkul' => 'SI-1111',
            'name' => 'Sistem Operasi',
            'semester_id' => 4,
            'created_at' => Carbon::create('2024', '11', '11', '18', '35', '23'),
            'updated_at' => Carbon::create('2024', '11', '11', '18', '35', '23'),
        ]);

        Mata_kuliah::create([
            'id' => 5,
            'kode_matkul' => 'SI-0898',
            'name' => 'Manajemen Organisasi',
            'semester_id' => 1,
            'created_at' => Carbon::create('2024', '11', '17', '06', '41', '42'),
            'updated_at' => Carbon::create('2024', '11', '17', '06', '41', '42'),
        ]);
    }
}