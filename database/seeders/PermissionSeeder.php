<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        //User Permission
        Permission::create([
            'name' => 'User.edit',
            'guard_name' => 'web',
            'group_name' => 'User'
        ]);

        Permission::create([
            'name' => 'User.delete',
            'guard_name' => 'web',
            'group_name' => 'User'
        ]);

        //Role & Permission

        Permission::create([
            'name' => 'Role',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        Permission::create([
            'name' => 'Role.edit',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        Permission::create([
            'name' => 'Role.delete',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        Permission::create([
            'name' => 'Role.create',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        Permission::create([
            'name' => 'Permission',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        Permission::create([
            'name' => 'Permission.edit',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        Permission::create([
            'name' => 'Permission.delete',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        Permission::create([
            'name' => 'Permission.create',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        //Content

        Permission::create([
            'name' => 'Content.create',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.kill',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.restore',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.delete',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.edit',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.category',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.tags',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.approve',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Comment',
            'guard_name' => 'web',
            'group_name' => 'Comment'
        ]);

        Permission::create([
            'name' => 'Favorite',
            'guard_name' => 'web',
            'group_name' => 'Favorite'
        ]);

        Permission::create([
            'name' => 'Subscriber',
            'guard_name' => 'web',
            'group_name' => 'Subscribers'
        ]);

        // //File Manager
        // Permission::create([
        //     'name' => 'FileManager.view',
        //     'guard_name' => 'web',
        //     'group_name' => 'FileManager'
        // ]);
        
    }
}
