<?php

declare(strict_types=1);

namespace App\Http\Queries\Users;

use App\Models\User;

class FetchUserByUuid
{
    public function handle(string $uuid): User|null
    {
        return User::whereUuid($uuid)->first();
    }
}
