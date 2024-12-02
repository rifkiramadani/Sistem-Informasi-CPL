<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; // Import Role model for assigning roles
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles if they do not exist
        $superAdminRole = Role::firstOrCreate(['name' => 'SuperAdmin/AkunSakti']);
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $operatorRole = Role::firstOrCreate(['name' => 'Operator']);
        $dosenRole = Role::firstOrCreate(['name' => 'Dosen']);
        $mahasiswaRole = Role::firstOrCreate(['name' => 'Mahasiswa']);

        // Creating the users based on the SQL data you provided
        $superAdmin = User::create([
            'id' => 1,
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => 'profile_pictures/ge7mxc4OSK5AMNTrEh76L8l07aaA5gzvboytzZ54.jpg',
            'password' => bcrypt('12345678'),  // Hashed password
            'remember_token' => null,
            'created_at' => '2024-11-25 08:30:29',
            'updated_at' => '2024-11-25 08:42:59',
        ]);
        $superAdmin->assignRole($superAdminRole); // Assign Super Admin Role

        $admin = User::create([
            'id' => 2,
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-11-25 07:39:42',
            'updated_at' => null,
        ]);
        $admin->assignRole($adminRole); // Assign Admin Role

        $operator = User::create([
            'id' => 3,
            'name' => 'Operator',
            'username' => 'operator',
            'email' => 'operator@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-10-14 08:51:39',
            'updated_at' => '2024-10-14 08:51:39',
        ]);
        $operator->assignRole($operatorRole); // Assign Operator Role

        $dosen = User::create([
            'id' => 4,
            'name' => 'Dosen',
            'username' => 'dosen',
            'email' => 'dosen@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-10-14 08:51:39',
            'updated_at' => '2024-10-14 08:51:39',
        ]);
        $dosen->assignRole($dosenRole); // Assign Dosen Role

        $mahasiswa = User::create([
            'id' => 5,
            'name' => 'Mahasiswa',
            'username' => 'mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-10-14 08:51:39',
            'updated_at' => '2024-10-14 08:51:39',
        ]);
        $mahasiswa->assignRole($mahasiswaRole); // Assign Mahasiswa Role

        // Additional users with specific roles
        $dwiSaputra = User::create([
            'id' => 22,
            'name' => 'Dwi Saputra S.kom',
            'username' => 'dwisaputra',
            'email' => 'putor@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => 'profile_pictures/wqWS3ErW6VqEMwcrt8uAOhi9jfpDWyzegwB6KlqW.png',
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-11-09 07:36:34',
            'updated_at' => '2024-11-25 08:55:24',
        ]);
        $dwiSaputra->assignRole($dosenRole); // Assign Dosen Role

        $salman = User::create([
            'id' => 27,
            'name' => 'Muhammad Salman Alfarizi S.Kom M.Sc',
            'username' => 'salman',
            'email' => 'salman@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-11-09 08:43:05',
            'updated_at' => '2024-11-09 08:43:05',
        ]);
        $salman->assignRole($dosenRole); // Assign Dosen Role

        $perdinan = User::create([
            'id' => 28,
            'name' => 'Perdinan S.H',
            'username' => 'perdinan',
            'email' => 'perdinan@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-11-11 07:14:03',
            'updated_at' => '2024-11-11 07:14:03',
        ]);
        $perdinan->assignRole($dosenRole); // Assign Dosen Role

        $ariq = User::create([
            'id' => 35,
            'name' => 'Muhammad Athariq S.komedi',
            'username' => 'ariq',
            'email' => 'ariq@gmail.com',
            'email_verified_at' => null,
            'profile_picture' => 'profile_pictures/JRnd6YWcYl6DOfQqrCnvArxayDfV5BNoCyIrw2t3.jpg',
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-11-25 07:58:30',
            'updated_at' => '2024-11-25 08:04:57',
        ]);
        $ariq->assignRole($operatorRole); // Assign Operator Role

        $yusran = User::create([
            'id' => 36,
            'name' => 'Yusran Panca Putra S.Kom M.Kom',
            'username' => 'yusran',
            'email' => 'yusran@unib.ac.id',
            'email_verified_at' => null,
            'profile_picture' => 'profile_pictures/ctOSJG51V2Xo122aFhAdKVSwMJFPPwr1Sby2yx5q.jpg',
            'password' => bcrypt('12345678'),
            'remember_token' => null,
            'created_at' => '2024-11-25 08:12:27',
            'updated_at' => '2024-11-25 08:20:24',
        ]);
        $yusran->assignRole($dosenRole); // Assign Dosen Role
    }
}