<?php

namespace Database\Seeders;

use App\Permissions\PostPermission;
use App\Permissions\UserPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => PostPermission::STORE]);
        Permission::create(['name' => PostPermission::UPDATE]);
        Permission::create(['name' => PostPermission::DESTROY]);
        Permission::create(['name' => UserPermission::INDEX]);
        Permission::create(['name' => UserPermission::STORE]);
        Permission::create(['name' => UserPermission::UPDATE]);
        Permission::create(['name' => UserPermission::DESTROY]);
        Permission::create(['name' => UserPermission::SET_ROLE]);
    }
}
