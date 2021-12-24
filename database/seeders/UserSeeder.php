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

        $adminRole = new User;
        $adminRole->name = 'Rizky Nurahman';
        $adminRole->email = 'admin@gmail.com';
        $adminRole->password = Hash::make('1');
        $adminRole->save();
        $adminRole->attachRole($admin);
    }
}
