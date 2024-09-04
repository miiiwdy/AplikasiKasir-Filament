<?php

namespace App\Policies;

use App\Models\User;
use App\Models\History;
use Illuminate\Auth\Access\HandlesAuthorization;

class HistoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_history');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, History $history): bool
    {
        return $user->can('view_history');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_history');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, History $history): bool
    {
        return $user->can('update_history');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, History $history): bool
    {
        return $user->can('delete_history');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_history');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, History $history): bool
    {
        return $user->can('force_delete_history');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_history');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, History $history): bool
    {
        return $user->can('restore_history');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_history');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, History $history): bool
    {
        return $user->can('replicate_history');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_history');
    }
}
