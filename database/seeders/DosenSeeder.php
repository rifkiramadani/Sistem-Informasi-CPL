<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use Carbon\Carbon;

class DosenSeeder extends Seeder
{
    public function run()
    {
        Dosen::create([
            'id' => 9,
            'user_id' => 28,
            'nip' => '7453244234',
            'created_at' => Carbon::create('2024', '11', '11', '07', '14', '04'),
            'updated_at' => Carbon::create('2024', '11', '11', '07', '14', '04'),
        ]);

        Dosen::create([
            'id' => 10,
            'user_id' => 36,
            'nip' => '236543252',
            'created_at' => Carbon::create('2024', '11', '25', '08', '12', '27'),
            'updated_at' => Carbon::create('2024', '11', '25', '08', '12', '27'),
        ]);
    }
}