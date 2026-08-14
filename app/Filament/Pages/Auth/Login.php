<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;

class Login extends BaseLogin
{
    public function getHeading(): string
    {
        return 'SIPANDAI BIDKUM';
    }

    public function getSubheading(): ?string
    {
        return 'Sistem Informasi Pengawasan dan Pendampingan Hukum';
    }
}