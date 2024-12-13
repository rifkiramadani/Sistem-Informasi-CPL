<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Operator;
use App\Models\Admin;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
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

        // Super Admin
        $superAdmin = User::create([
            'id' => 1,
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => 'profile_pictures/ge7mxc4OSK5AMNTrEh76L8l07aaA5gzvboytzZ54.jpg',
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $superAdmin->assignRole($superAdminRole); // Assign Super Admin Role

        // Admin
        $admin = User::create([
            'id' => 2,
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin->assignRole($adminRole); // Assign Admin Role

        // Operator
        $operator = User::create([
            'id' => 3,
            'name' => 'Operator',
            'username' => 'operator',
            'email' => 'operator@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $operator->assignRole($operatorRole); // Assign Operator Role
        Operator::create(['user_id' => $operator->id, 'nip' => '3123151134']);

        // Dosen
        $dosen = User::create([
            'id' => 4,
            'name' => 'Dosen',
            'username' => 'dosen',
            'email' => 'dosen@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $dosen->assignRole($dosenRole); // Assign Dosen Role

        // Create related Dosen record
        $dosenProfile = Dosen::create([
            'user_id' => $dosen->id,
            'nip'=>'123456789'
            // Add other necessary attributes for Dosen model, if applicable
        ]);

        // Mahasiswa
        $mahasiswa = User::create([
            'id' => 5,
            'name' => 'Mahasiswa',
            'username' => 'mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $mahasiswa->assignRole($mahasiswaRole); // Assign Mahasiswa Role

        // Create related Mahasiswa record
        $mahasiswaProfile = Mahasiswa::create([
            'user_id' => $mahasiswa->id,
            // 'semester_id' => 1, // Assign a default semester, adjust as needed
            'npm' => '123456789'
            // Add other necessary attributes for Mahasiswa model
        ]);

        // Additional Dosen with profiles
        $dwiSaputra = User::create([
            'id' => 22,
            'name' => 'Dwi Saputra S.kom',
            'username' => 'dwisaputra',
            'email' => 'putor@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => 'profile_pictures/wqWS3ErW6VqEMwcrt8uAOhi9jfpDWyzegwB6KlqW.png',
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $dwiSaputra->assignRole($dosenRole); // Assign Dosen Role
        Dosen::create(['user_id' => $dwiSaputra->id, 'nip' => '123456799']);

        // More Dosen with profiles (example)
        $salman = User::create([
            'id' => 27,
            'name' => 'Muhammad Salman Alfarizi S.Kom M.Sc',
            'username' => 'salman',
            'email' => 'salman@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => null,
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $salman->assignRole($dosenRole);
        Dosen::create(['user_id' => $salman->id, 'nip' => '123456719']);

        // Operator
        $ariq = User::create([
            'id' => 35,
            'name' => 'Muhammad Athariq S.komedi',
            'username' => 'ariq',
            'email' => 'ariq@gmail.com',
            'email_verified_at' => now(),
            'profile_picture' => 'profile_pictures/JRnd6YWcYl6DOfQqrCnvArxayDfV5BNoCyIrw2t3.jpg',
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $ariq->assignRole($operatorRole); // Assign Operator Role
        Operator::create(['user_id' => $ariq->id, 'nip' => '31231234']);

        // More Users and Profiles...
        // Yusran Dosen Example
        $yusran = User::create([
            'id' => 36,
            'name' => 'Yusran Panca Putra S.Kom M.Kom',
            'username' => 'yusran',
            'email' => 'yusran@unib.ac.id',
            'email_verified_at' => now(),
            'profile_picture' => 'profile_pictures/ctOSJG51V2Xo122aFhAdKVSwMJFPPwr1Sby2yx5q.jpg',
            'password' => bcrypt('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $yusran->assignRole($dosenRole); // Assign Dosen Role
        Dosen::create(['user_id' => $yusran->id, 'nip' => '143456789']);
    }
}