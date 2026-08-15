<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\HasilPsh;
use Illuminate\Auth\Access\HandlesAuthorization;

class HasilPshPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:HasilPsh');
    }

    public function view(AuthUser $authUser, HasilPsh $hasilPsh): bool
    {
        return $authUser->can('View:HasilPsh');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:HasilPsh');
    }

    public function update(AuthUser $authUser, HasilPsh $hasilPsh): bool
    {
        return $authUser->can('Update:HasilPsh');
    }

    public function delete(AuthUser $authUser, HasilPsh $hasilPsh): bool
    {
        return $authUser->can('Delete:HasilPsh');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:HasilPsh');
    }

    public function restore(AuthUser $authUser, HasilPsh $hasilPsh): bool
    {
        return $authUser->can('Restore:HasilPsh');
    }

    public function forceDelete(AuthUser $authUser, HasilPsh $hasilPsh): bool
    {
        return $authUser->can('ForceDelete:HasilPsh');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:HasilPsh');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:HasilPsh');
    }

    public function replicate(AuthUser $authUser, HasilPsh $hasilPsh): bool
    {
        return $authUser->can('Replicate:HasilPsh');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:HasilPsh');
    }

}