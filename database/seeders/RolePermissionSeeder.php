<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission untuk admin
        Permission::create(['name' => 'tambah-admin']);
        Permission::create(['name' => 'edit-admin']);
        Permission::create(['name' => 'hapus-admin']);
        Permission::create(['name' => 'lihat-admin']);

        //permission untuk operator
        Permission::create(['name' => 'tambah-operator']);
        Permission::create(['name' => 'edit-operator']);
        Permission::create(['name' => 'hapus-operator']);
        Permission::create(['name' => 'lihat-operator']);

        //permission untuk dosen
        Permission::create(['name' => 'tambah-dosen']);
        Permission::create(['name' => 'edit-dosen']);
        Permission::create(['name' => 'hapus-dosen']);
        Permission::create(['name' => 'lihat-dosen']);

        //permission untuk mahasiswa
        Permission::create(['name' => 'tambah-mahasiswa']);
        Permission::create(['name' => 'tambah-nilai-mahasiswa']);
        Permission::create(['name' => 'edit-mahasiswa']);
        Permission::create(['name' => 'hapus-mahasiswa']);
        Permission::create(['name' => 'lihat-mahasiswa']);

        //permission untuk cpl
        Permission::create(['name' => 'tambah-cpl']);
        Permission::create(['name' => 'edit-cpl']);
        Permission::create(['name' => 'hapus-cpl']);
        Permission::create(['name' => 'lihat-cpl']);

        //permission untuk cpmk
        Permission::create(['name' => 'tambah-cpmk']);
        Permission::create(['name' => 'edit-cpmk']);
        Permission::create(['name' => 'hapus-cpmk']);
        Permission::create(['name' => 'lihat-cpmk']);

        //ROLE
        Role::create(['name' => 'SuperAdmin/AkunSakti']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Operator']);
        Role::create(['name' => 'Dosen']);
        Role::create(['name' => 'Mahasiswa']);

        //memberikan permission kepada super admin
        $roleSuperAdmin = Role::findByName('SuperAdmin/AkunSakti');
        $roleSuperAdmin->givePermissionTo('tambah-admin');
        $roleSuperAdmin->givePermissionTo('edit-admin');
        $roleSuperAdmin->givePermissionTo('hapus-admin');
        $roleSuperAdmin->givePermissionTo('lihat-admin');

        $roleSuperAdmin->givePermissionTo('tambah-operator');
        $roleSuperAdmin->givePermissionTo('edit-operator');
        $roleSuperAdmin->givePermissionTo('hapus-operator');
        $roleSuperAdmin->givePermissionTo('lihat-operator');

        $roleSuperAdmin->givePermissionTo('tambah-dosen');
        $roleSuperAdmin->givePermissionTo('edit-dosen');
        $roleSuperAdmin->givePermissionTo('hapus-dosen');
        $roleSuperAdmin->givePermissionTo('lihat-dosen');

        $roleSuperAdmin->givePermissionTo('tambah-mahasiswa');
        $roleSuperAdmin->givePermissionTo('edit-mahasiswa');
        $roleSuperAdmin->givePermissionTo('hapus-mahasiswa');
        $roleSuperAdmin->givePermissionTo('lihat-mahasiswa');

        $roleSuperAdmin->givePermissionTo('tambah-cpl');
        $roleSuperAdmin->givePermissionTo('edit-cpl');
        $roleSuperAdmin->givePermissionTo('hapus-cpl');
        $roleSuperAdmin->givePermissionTo('lihat-cpl');

        $roleSuperAdmin->givePermissionTo('tambah-cpmk');
        $roleSuperAdmin->givePermissionTo('edit-cpmk');
        $roleSuperAdmin->givePermissionTo('hapus-cpmk');
        $roleSuperAdmin->givePermissionTo('lihat-cpmk');

        //memberikan permission kepada admin
        $roleAdmin = Role::findByName('Admin');
        $roleAdmin->givePermissionTo('tambah-operator');
        $roleAdmin->givePermissionTo('edit-operator');
        $roleAdmin->givePermissionTo('hapus-operator');
        $roleAdmin->givePermissionTo('lihat-operator');

        $roleAdmin->givePermissionTo('tambah-dosen');
        $roleAdmin->givePermissionTo('edit-dosen');
        $roleAdmin->givePermissionTo('hapus-dosen');
        $roleAdmin->givePermissionTo('lihat-dosen');

        $roleAdmin->givePermissionTo('tambah-mahasiswa');
        $roleAdmin->givePermissionTo('edit-mahasiswa');
        $roleAdmin->givePermissionTo('hapus-mahasiswa');
        $roleAdmin->givePermissionTo('lihat-mahasiswa');

        $roleAdmin->givePermissionTo('tambah-cpl');
        $roleAdmin->givePermissionTo('edit-cpl');
        $roleAdmin->givePermissionTo('hapus-cpl');
        $roleAdmin->givePermissionTo('lihat-cpl');

        $roleAdmin->givePermissionTo('tambah-cpmk');
        $roleAdmin->givePermissionTo('edit-cpmk');
        $roleAdmin->givePermissionTo('hapus-cpmk');
        $roleAdmin->givePermissionTo('lihat-cpmk');

        //memberikan permission kepada operator 
        $roleOperator = Role::findByName('Operator');
        $roleOperator->givePermissionTo('tambah-dosen');
        $roleOperator->givePermissionTo('edit-dosen');
        $roleOperator->givePermissionTo('hapus-dosen');
        $roleOperator->givePermissionTo('lihat-dosen');

        $roleOperator->givePermissionTo('tambah-mahasiswa');
        $roleOperator->givePermissionTo('edit-mahasiswa');
        $roleOperator->givePermissionTo('hapus-mahasiswa');
        $roleOperator->givePermissionTo('lihat-mahasiswa');

        $roleOperator->givePermissionTo('tambah-cpl');
        $roleOperator->givePermissionTo('edit-cpl');
        $roleOperator->givePermissionTo('hapus-cpl');
        $roleOperator->givePermissionTo('lihat-cpl');

        $roleOperator->givePermissionTo('tambah-cpmk');
        $roleOperator->givePermissionTo('edit-cpmk');
        $roleOperator->givePermissionTo('hapus-cpmk');
        $roleOperator->givePermissionTo('lihat-cpmk');

        //memberikan permission kepada dosen
        $roleDosen = Role::findByName('Dosen');
        $roleDosen->givePermissionTo('tambah-nilai-mahasiswa');
        $roleDosen->givePermissionTo('edit-mahasiswa');
        $roleDosen->givePermissionTo('hapus-mahasiswa');
        $roleDosen->givePermissionTo('lihat-mahasiswa');

        //memberikan permission kepada mahasiswa
        $roleMahasiswa = Role::findByName('Mahasiswa');
        $roleMahasiswa->givePermissionTo('lihat-mahasiswa');

    }
}
