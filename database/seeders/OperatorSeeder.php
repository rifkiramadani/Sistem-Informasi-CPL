<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operator;

class OperatorSeeder extends Seeder
{
    public function run()
    {
        // Creating Operators
        Operator::create([
            'user_id' => 27,
            'nip' => '19231561434234',
            'created_at' => '2024-11-09 08:43:06',
            'updated_at' => '2024-11-09 08:43:06',
        ]);

        Operator::create([
            'user_id' => 35,
            'nip' => '323254324525',
            'created_at' => '2024-11-25 07:58:30',
            'updated_at' => '2024-11-25 07:58:30',
        ]);
    }
}