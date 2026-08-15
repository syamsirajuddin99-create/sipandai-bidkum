<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PengajuanPsh;
use Illuminate\Auth\Access\HandlesAuthorization;

class PengajuanPshPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PengajuanPsh');
    }

    public function view(AuthUser $authUser, PengajuanPsh $pengajuanPsh): bool
    {
        return $authUser->can('View:PengajuanPsh');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PengajuanPsh');
    }

    public function update(AuthUser $authUser, PengajuanPsh $pengajuanPsh): bool
    {
        return $authUser->can('Update:PengajuanPsh');
    }

    public function delete(AuthUser $authUser, PengajuanPsh $pengajuanPsh): bool
    {
        return $authUser->can('Delete:PengajuanPsh');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PengajuanPsh');
    }

    public function restore(AuthUser $authUser, PengajuanPsh $pengajuanPsh): bool
    {
        return $authUser->can('Restore:PengajuanPsh');
    }

    public function forceDelete(AuthUser $authUser, PengajuanPsh $pengajuanPsh): bool
    {
        return $authUser->can('ForceDelete:PengajuanPsh');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PengajuanPsh');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PengajuanPsh');
    }

    public function replicate(AuthUser $authUser, PengajuanPsh $pengajuanPsh): bool
    {
        return $authUser->can('Replicate:PengajuanPsh');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PengajuanPsh');
    }

}