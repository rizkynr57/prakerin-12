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
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'User Administrator'
        ]);

        $pengguna = Role::create([
            'name' => 'pengguna',
            'display_name' => 'User Biasa'
        ]);


        $user = new User();
        $user->name = 'Rizky Nurahman';
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('1');
        $user->save();

        $pengunjung = new User();
        $pengunjung->name = 'Rico Achmad';
        $pengunjung->email = 'pengunjung@gmail.com';
        $pengunjung->password = Hash::make('2');
        $pengunjung->save();

        $user->attachRole($admin);
        $pengunjung->attachRole($pengguna);
    }
}
