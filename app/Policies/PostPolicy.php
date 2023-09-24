<?php

namespace App\Policies;

use App\Permissions\PostPermission;

class PostPolicy extends BasePolicy
{
    public function store(): bool
    {
        return $this->user->can(PostPermission::STORE);
    }

    public function update(): bool
    {
        return $this->user->can(PostPermission::UPDATE);
    }

    public function destroy(): bool
    {
        return $this->user->can(PostPermission::DESTROY);
    }
}
