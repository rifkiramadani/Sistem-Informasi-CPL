<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cpl;
use Carbon\Carbon;

class CplSeeder extends Seeder
{
    public function run()
    {
        Cpl::create([
            'id' => 8,
            'name' => 'CPL-01',
            'deskripsi' => 'ini adalah cpl 01',
            'created_at' => Carbon::create('2024', '10', '14', '08', '22', '28'),
            'updated_at' => Carbon::create('2024', '10', '14', '08', '22', '28'),
        ]);

        Cpl::create([
            'id' => 11,
            'name' => 'CPL-02',
            'deskripsi' => 'ini adalah cpl 02',
            'created_at' => Carbon::create('2024', '10', '19', '06', '38', '42'),
            'updated_at' => Carbon::create('2024', '10', '19', '06', '38', '42'),
        ]);

        Cpl::create([
            'id' => 12,
            'name' => 'CPL-03',
            'deskripsi' => 'ini adalah cpl 03',
            'created_at' => Carbon::create('2024', '10', '19', '07', '31', '50'),
            'updated_at' => Carbon::create('2024', '10', '19', '07', '31', '50'),
        ]);

        Cpl::create([
            'id' => 13,
            'name' => 'CPL-04',
            'deskripsi' => 'ini adalah cpl 04',
            'created_at' => Carbon::create('2024', '10', '19', '07', '40', '05'),
            'updated_at' => Carbon::create('2024', '10', '19', '07', '40', '05'),
        ]);

        Cpl::create([
            'id' => 14,
            'name' => 'CPL-05',
            'deskripsi' => 'ini cpl 05',
            'created_at' => Carbon::create('2024', '10', '21', '00', '07', '57'),
            'updated_at' => Carbon::create('2024', '10', '21', '00', '07', '57'),
        ]);

        Cpl::create([
            'id' => 16,
            'name' => 'CPL-06',
            'deskripsi' => 'ini adalah cpl 06',
            'created_at' => Carbon::create('2024', '11', '17', '06', '51', '30'),
            'updated_at' => Carbon::create('2024', '11', '17', '06', '51', '30'),
        ]);
    }
}