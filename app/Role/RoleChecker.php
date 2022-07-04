<?php

namespace App\Role;

use App\Models\User;

/**
 * Class RoleChecker
 * @package App\Role
 */
class RoleChecker
{
    /**
     * @param User $user
     * @param string $requestedRole
     * @return bool
     */
    public static function check(User $user, string $requestedRole): bool
    {
        // Admin has everything

        // rôles du user
        //dd($user->getRoles()); // ROLE_CONTRIBUTOR

        if ($user->hasRole(UserRole::ROLE_ADMIN)) {
            return true;
        }

        // Rôles hérités du user
        $heritedRoles = [];
        foreach($user->getRoles() as $role) {
            $heritedRoles[] = $role;
            $heritedRoles = array_merge($heritedRoles, UserRole::getAllowedRoles($role));
        }
        $heritedRoles = array_unique($heritedRoles);

        if (in_array($requestedRole, $heritedRoles)) {
            return true;
        }

        return false;
    }
}
