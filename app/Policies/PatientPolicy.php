<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\Patient;
use App\Models\User;

class PatientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if (in_array($user->role, [UserRole::ADMIN, UserRole::DOCTOR, UserRole::NURSE])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Patient $patient): bool
    {
        if (in_array($user->role, [UserRole::ADMIN, UserRole::DOCTOR, UserRole::NURSE])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if (in_array($user->role, [UserRole::ADMIN, UserRole::DOCTOR, UserRole::NURSE])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Patient $patient): bool
    {
        if (in_array($user->role, [UserRole::ADMIN, UserRole::DOCTOR, UserRole::NURSE])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Patient $patient): bool
    {
        if ($user->role === UserRole::ADMIN) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Patient $patient): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Patient $patient): bool
    {
        return false;
    }
}
