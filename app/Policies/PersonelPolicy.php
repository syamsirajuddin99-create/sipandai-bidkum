<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Personel;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonelPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Personel');
    }

    public function view(AuthUser $authUser, Personel $personel): bool
    {
        return $authUser->can('View:Personel');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Personel');
    }

    public function update(AuthUser $authUser, Personel $personel): bool
    {
        return $authUser->can('Update:Personel');
    }

    public function delete(AuthUser $authUser, Personel $personel): bool
    {
        return $authUser->can('Delete:Personel');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:Personel');
    }

    public function restore(AuthUser $authUser, Personel $personel): bool
    {
        return $authUser->can('Restore:Personel');
    }

    public function forceDelete(AuthUser $authUser, Personel $personel): bool
    {
        return $authUser->can('ForceDelete:Personel');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Personel');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Personel');
    }

    public function replicate(AuthUser $authUser, Personel $personel): bool
    {
        return $authUser->can('Replicate:Personel');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Personel');
    }

}