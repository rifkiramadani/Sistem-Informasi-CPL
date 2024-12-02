<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'id' => 4,
            'user_id' => 22,
            'nip' => '3123453643545324',
            'created_at' => Carbon::create('2024', '11', '09', '07', '36', '34'),
            'updated_at' => Carbon::create('2024', '11', '09', '07', '36', '34'),
        ]);
    }
}