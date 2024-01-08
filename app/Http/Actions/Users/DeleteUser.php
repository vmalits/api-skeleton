<?php

declare(strict_types=1);

namespace App\Http\Actions\Users;

use App\Models\User;

class DeleteUser
{
    public function handle(User $user): void
    {
        $user->delete();
    }
}
