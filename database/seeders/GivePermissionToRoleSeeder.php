<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Permissions\PostPermission;
use App\Permissions\UserPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class GivePermissionToRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::get();

        /** @var Role $role */
        foreach ($roles as $role) {
            if ((int) $role->name === RoleEnum::EDITOR) {
                $role->givePermissionTo([
                    PostPermission::STORE,
                    PostPermission::UPDATE,
                    PostPermission::DESTROY,
                ]);
            } elseif ((int) $role->name === RoleEnum::ADMIN) {
                $role->givePermissionTo([
                    PostPermission::STORE,
                    PostPermission::UPDATE,
                    PostPermission::DESTROY,
                    UserPermission::INDEX,
                    UserPermission::STORE,
                    UserPermission::UPDATE,
                    UserPermission::DESTROY,
                    UserPermission::SET_ROLE,
                ]);
            }
        }
    }
}
