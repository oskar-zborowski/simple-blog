<?php

namespace App\Repositories;

use App\Enums\RoleEnum;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers()
    {
        return User::paginate(10);
    }

    public function createUser(array $userDetails)
    {
        $user = User::create($userDetails);
        $user->assignRole(RoleEnum::USER);

        return $user;
    }

    public function updateUser(User $user, array $newUserDetails): bool
    {
        return $user->update($newUserDetails);
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }

    public function setUserRole(User $user, int $role): User
    {
        $user->assignRole($role);

        return $user;
    }
}
