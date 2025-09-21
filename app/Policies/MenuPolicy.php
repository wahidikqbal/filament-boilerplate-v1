<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Menu;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy extends BasePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Menu');
    }

    public function view(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('View:Menu') && $menu->user_id === $authUser->id;
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Menu');
    }

    public function update(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('Update:Menu') && $menu->user_id === $authUser->id;
    }

    public function delete(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('Delete:Menu') && $menu->user_id === $authUser->id;
    }

    public function restore(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('Restore:Menu') && $menu->user_id === $authUser->id;
    }

    public function forceDelete(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('ForceDelete:Menu') && $menu->user_id === $authUser->id;
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Menu');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Menu');
    }

    public function replicate(AuthUser $authUser, Menu $menu): bool
    {
        return $authUser->can('Replicate:Menu') && $menu->user_id === $authUser->id;
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Menu');
    }
}
