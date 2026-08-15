<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PenugasanPsh;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenugasanPshPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PenugasanPsh');
    }

    public function view(AuthUser $authUser, PenugasanPsh $penugasanPsh): bool
    {
        return $authUser->can('View:PenugasanPsh');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PenugasanPsh');
    }

    public function update(AuthUser $authUser, PenugasanPsh $penugasanPsh): bool
    {
        return $authUser->can('Update:PenugasanPsh');
    }

    public function delete(AuthUser $authUser, PenugasanPsh $penugasanPsh): bool
    {
        return $authUser->can('Delete:PenugasanPsh');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:PenugasanPsh');
    }

    public function restore(AuthUser $authUser, PenugasanPsh $penugasanPsh): bool
    {
        return $authUser->can('Restore:PenugasanPsh');
    }

    public function forceDelete(AuthUser $authUser, PenugasanPsh $penugasanPsh): bool
    {
        return $authUser->can('ForceDelete:PenugasanPsh');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PenugasanPsh');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PenugasanPsh');
    }

    public function replicate(AuthUser $authUser, PenugasanPsh $penugasanPsh): bool
    {
        return $authUser->can('Replicate:PenugasanPsh');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PenugasanPsh');
    }

}