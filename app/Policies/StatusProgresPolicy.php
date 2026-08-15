<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\StatusProgres;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusProgresPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:StatusProgres');
    }

    public function view(AuthUser $authUser, StatusProgres $statusProgres): bool
    {
        return $authUser->can('View:StatusProgres');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:StatusProgres');
    }

    public function update(AuthUser $authUser, StatusProgres $statusProgres): bool
    {
        return $authUser->can('Update:StatusProgres');
    }

    public function delete(AuthUser $authUser, StatusProgres $statusProgres): bool
    {
        return $authUser->can('Delete:StatusProgres');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:StatusProgres');
    }

    public function restore(AuthUser $authUser, StatusProgres $statusProgres): bool
    {
        return $authUser->can('Restore:StatusProgres');
    }

    public function forceDelete(AuthUser $authUser, StatusProgres $statusProgres): bool
    {
        return $authUser->can('ForceDelete:StatusProgres');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:StatusProgres');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:StatusProgres');
    }

    public function replicate(AuthUser $authUser, StatusProgres $statusProgres): bool
    {
        return $authUser->can('Replicate:StatusProgres');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:StatusProgres');
    }

}