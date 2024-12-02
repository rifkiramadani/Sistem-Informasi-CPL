<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use App\Models\Mata_kuliah;

class DosenMataKuliahSeeder extends Seeder
{
    public function run()
    {
        // Dosen and Mata_kuliah associations

        $dosen1 = Dosen::find(6);  // Dosen with ID 6
        $mataKuliah1 = Mata_kuliah::find(1);  // Mata Kuliah with ID 1
        $dosen1->matakuliah()->attach($mataKuliah1);

        $dosen2 = Dosen::find(5);  // Dosen with ID 5
        $mataKuliah2 = Mata_kuliah::find(2);  // Mata Kuliah with ID 2
        $dosen2->matakuliah()->attach($mataKuliah2);

        $dosen3 = Dosen::find(8);  // Dosen with ID 8
        $mataKuliah3 = Mata_kuliah::find(1);  // Mata Kuliah with ID 1
        $dosen3->matakuliah()->attach($mataKuliah3);

        $dosen4 = Dosen::find(8);  // Dosen with ID 8
        $mataKuliah4 = Mata_kuliah::find(2);  // Mata Kuliah with ID 2
        $dosen4->matakuliah()->attach($mataKuliah4);
    }
}