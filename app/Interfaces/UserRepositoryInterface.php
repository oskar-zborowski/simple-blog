<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllUsers();
    public function createUser(array $userDetails);
    public function updateUser(User $user, array $newUserDetails);
    public function deleteUser(User $user);
    public function setUserRole(User $user, int $role);
}
