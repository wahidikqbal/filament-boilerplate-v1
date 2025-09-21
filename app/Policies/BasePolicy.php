<?php

namespace App\Policies;

use App\Models\User;

abstract class BasePolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return null; // Lanjut ke policy biasa
    }
}
