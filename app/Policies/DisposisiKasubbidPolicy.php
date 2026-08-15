<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\DisposisiKasubbid;
use Illuminate\Auth\Access\HandlesAuthorization;

class DisposisiKasubbidPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:DisposisiKasubbid');
    }

    public function view(AuthUser $authUser, DisposisiKasubbid $disposisiKasubbid): bool
    {
        return $authUser->can('View:DisposisiKasubbid');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:DisposisiKasubbid');
    }

    public function update(AuthUser $authUser, DisposisiKasubbid $disposisiKasubbid): bool
    {
        return $authUser->can('Update:DisposisiKasubbid');
    }

    public function delete(AuthUser $authUser, DisposisiKasubbid $disposisiKasubbid): bool
    {
        return $authUser->can('Delete:DisposisiKasubbid');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:DisposisiKasubbid');
    }

    public function restore(AuthUser $authUser, DisposisiKasubbid $disposisiKasubbid): bool
    {
        return $authUser->can('Restore:DisposisiKasubbid');
    }

    public function forceDelete(AuthUser $authUser, DisposisiKasubbid $disposisiKasubbid): bool
    {
        return $authUser->can('ForceDelete:DisposisiKasubbid');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:DisposisiKasubbid');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:DisposisiKasubbid');
    }

    public function replicate(AuthUser $authUser, DisposisiKasubbid $disposisiKasubbid): bool
    {
        return $authUser->can('Replicate:DisposisiKasubbid');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:DisposisiKasubbid');
    }

}