<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RoleEnum extends Enum
{
    const USER = 1;

    const EDITOR = 2;

    const ADMIN = 3;
}
