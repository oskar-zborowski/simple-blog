<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class BasePolicy
{
    use HandlesAuthorization;

    protected ?User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
}
