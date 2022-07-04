<?php

namespace App\Role;

/***
 * Class UserRole
 * @package App\Role
 */
class UserRole {

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_GESTIONNAIRE = 'ROLE_GESTIONNAIRE';
    const ROLE_CLIENT = 'ROLE_CLIENT';
    const ROLE_VISITEUR = 'ROLE_VISITEUR';

    /**
     * @var array
     */
    protected static $roleHierarchy = [
        self::ROLE_ADMIN => [
            self::ROLE_GESTIONNAIRE,
            self::ROLE_CLIENT,
            self::ROLE_VISITEUR,
        ],
        self::ROLE_GESTIONNAIRE => [
            self::ROLE_CLIENT,
            self::ROLE_VISITEUR,
        ],
        self::ROLE_CLIENT => [
            self::ROLE_VISITEUR
        ],
        self::ROLE_VISITEUR => []
    ];

    /**
     * @param string $role
     * @return array
     */
    public static function getAllowedRoles(string $role): array
    {
        if (isset(self::$roleHierarchy[$role])) {
            return self::$roleHierarchy[$role];
        }

        return [];
    }

    /***
     * @return array
     */
    public static function getRoleList(): array
    {
        return [
            static::ROLE_ADMIN =>'Admin',
            static::ROLE_GESTIONNAIRE => 'Gestionnaire',
            static::ROLE_CLIENT => 'Client',
            static::ROLE_VISITEUR => 'Visiteur',

        ];
    }

}
