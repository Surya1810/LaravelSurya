<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'username' => 'Super Admin',
            'email' => 'SuperAdmin@example.com',
            'phone' => '089512776878',
            'password' => bcrypt('password')
        ]);

        $superadmin->assignRole('super admin');

        $admin = User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'Admin@example.com',
            'phone' => '089512776878',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole('admin');

        $operator = User::create([
            'name' => 'Operator',
            'username' => 'Operator',
            'email' => 'Operator@example.com',
            'phone' => '089512776878',
            'password' => bcrypt('password')
        ]);

        $operator->assignRole('operator');

        $guest = User::create([
            'name' => 'Guest',
            'username' => 'Guest',
            'email' => 'Guest@example.com',
            'phone' => '089512776878',
            'password' => bcrypt('password')
        ]);

        $guest->assignRole('guest');
    }
}
