<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = "admin";
        $admin->display_name = "Administrator";
        $admin->save();

        $petugas = new Role();
        $petugas->name = "petugas";
        $petugas->display_name = "Petugas";
        $petugas->save();


        $adminRole = new User;
        $adminRole->name = 'Rizky Nurahman';
        $adminRole->jenis_kelamin = 'L';
        $adminRole->agama = 'Islam';
        $adminRole->alamat = 'Bandung';
        $adminRole->no_telp = '0894';
        $adminRole->jabatan = 'Admin';
        $adminRole->email = 'admin@gmail.com';
        $adminRole->password = Hash::make('1');
        $adminRole->save();
        $adminRole->attachRole($admin);

        $petugasRole = new User;
        $petugasRole->name = 'petugas';
        $petugasRole->jenis_kelamin = 'L';
        $petugasRole->agama = 'Islam';
        $petugasRole->alamat = 'Bandung';
        $petugasRole->no_telp = '0894';
        $petugasRole->jabatan = 'Petugas';
        $petugasRole->email = 'petugas@gmail.com';
        $petugasRole->password = Hash::make('2');
        $petugasRole->save();
        $petugasRole->attachRole($petugas);
    }
}
