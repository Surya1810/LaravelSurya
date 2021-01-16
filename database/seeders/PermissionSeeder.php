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
        //dashboard Permission
        Permission::create([
            'name' => 'Dashboard.view',
            'guard_name' => 'web',
            'group_name' => 'Dashboard'
        ]);

        
        //User Permission
        Permission::create([
            'name' => 'User.view',
            'guard_name' => 'web',
            'group_name' => 'User'
        ]);

        Permission::create([
            'name' => 'User.edit',
            'guard_name' => 'web',
            'group_name' => 'User'
        ]);

        Permission::create([
            'name' => 'User.create',
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
            'name' => 'Role.Permission.view',
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
            'name' => 'Role.list',
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
        Permission::create([
            'name' => 'Permission.list',
            'guard_name' => 'web',
            'group_name' => 'Role & Permission'
        ]);

        //Content
        Permission::create([
            'name' => 'Content.view',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.create',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Content.trashed',
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
            'name' => 'Content.restore',
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
            'name' => 'Content.post',
            'guard_name' => 'web',
            'group_name' => 'Content'
        ]);

        Permission::create([
            'name' => 'Comment.view',
            'guard_name' => 'web',
            'group_name' => 'Comment'
        ]);

        Permission::create([
            'name' => 'Favorite.view',
            'guard_name' => 'web',
            'group_name' => 'Comment'
        ]);

        Permission::create([
            'name' => 'Subs.view',
            'guard_name' => 'web',
            'group_name' => 'Subscribers'
        ]);

        //File Manager
        Permission::create([
            'name' => 'FileManager.view',
            'guard_name' => 'web',
            'group_name' => 'FileManager'
        ]);
        
    }
}
