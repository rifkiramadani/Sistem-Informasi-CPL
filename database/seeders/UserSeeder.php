<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //membuat user untuk super admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        //memberikan role super admin
        $superAdmin->assignRole('SuperAdmin/AkunSakti');

        // //membuat user untuk admin
        // $admin = User::create([
        //     'name' => 'Admin',
        //     'username' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt('12345678')
        // ]);
        // //memberikan role admin
        // $admin->assignRole('Admin');

        // //membuat user untuk operator
        $operator = User::create([
            'name' => 'Operator',
            'username' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        //memberikan role operator
        $operator->assignRole('Operator');

        //membuat user untuk dosen
        $dosen = User::create([
            'name' => 'Dosen',
            'username' => 'dosen',
            'email' => 'dosen@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        //memberikan role dosen
        $dosen->assignRole('Dosen');

        //membuat user untuk mahasiswa
        $mahasiswa = User::create([
            'name' => 'Mahasiswa',
            'username' => 'mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('12345678')
        ]);
        //memberikan role mahasiswa
        $mahasiswa->assignRole('Mahasiswa');
    }
}