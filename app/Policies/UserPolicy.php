<?php

namespace App\Policies;

use App\Permissions\UserPermission;

class UserPolicy extends BasePolicy
{
    public function index(): bool
    {
        return $this->user->can(UserPermission::INDEX);
    }

    public function store(): bool
    {
        return $this->user->can(UserPermission::STORE);
    }

    public function update(): bool
    {
        return $this->user->can(UserPermission::UPDATE);
    }

    public function destroy(): bool
    {
        return $this->user->can(UserPermission::DESTROY);
    }

    public function setRole(): bool
    {
        return $this->user->can(UserPermission::SET_ROLE);
    }
}
