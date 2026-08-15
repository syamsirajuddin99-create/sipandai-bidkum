<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Satker;
use Illuminate\Auth\Access\HandlesAuthorization;

class SatkerPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Satker');
    }

    public function view(AuthUser $authUser, Satker $satker): bool
    {
        return $authUser->can('View:Satker');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Satker');
    }

    public function update(AuthUser $authUser, Satker $satker): bool
    {
        return $authUser->can('Update:Satker');
    }

    public function delete(AuthUser $authUser, Satker $satker): bool
    {
        return $authUser->can('Delete:Satker');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Satker');
    }

    public function restore(AuthUser $authUser, Satker $satker): bool
    {
        return $authUser->can('Restore:Satker');
    }

    public function forceDelete(AuthUser $authUser, Satker $satker): bool
    {
        return $authUser->can('ForceDelete:Satker');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Satker');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Satker');
    }

    public function replicate(AuthUser $authUser, Satker $satker): bool
    {
        return $authUser->can('Replicate:Satker');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Satker');
    }

}