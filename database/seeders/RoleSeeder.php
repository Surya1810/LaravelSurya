<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $SuperAdmin = Role::create([
            'name' => 'super admin',
            'guard_name' => 'web'
        ]);

        $Admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $Operator = Role::create([
            'name' => 'operator',
            'guard_name' => 'web'
        ]);

        $Guest = Role::create([
            'name' => 'guest',
            'guard_name' => 'web'
        ]);
    }

}
