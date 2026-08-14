<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccessControl
{
    public static function user(): ?User
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user;
    }

    public static function hasRole(string $role): bool
    {
        return self::user()?->hasRole($role) ?? false;
    }

    public static function hasAnyRole(array $roles): bool
    {
        return self::user()?->hasAnyRole($roles) ?? false;
    }
}