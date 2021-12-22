<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = new User();
        $user->name = 'Rizky Nurahman';
        $user->email = 'rizky@gmail.com';
        $user->password = Hash::make('1');
        $user->save();

        $user = new User();
        $user->name = 'Rico Achmad';
        $user->email = 'rico@gmail.com';
        $user->password = Hash::make('2');
        $user->save();

        $user = new User();
        $user->name = 'Zulfan M';
        $user->email = 'zulfan@gmail.com';
        $user->password = Hash::make('3');
        $user->save();

        $user = new User();
        $user->name = 'Syukur S';
        $user->email = 'syukur@gmail.com';
        $user->password = Hash::make('4');
        $user->save();

        $user = new User();
        $user->name = 'Aziz TB';
        $user->email = 'aziz@gmail.com';
        $user->password = Hash::make('5');
        $user->save();
    }
}
