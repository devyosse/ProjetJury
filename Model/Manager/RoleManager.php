<?php

namespace App\Model\Manager;

use App\Model\Database;
use App\Model\Entity\Role;
use User;

final class RoleManager
{
    public const ROLE_ADMIN = 'Admin';
    public const ROLE_USER = 'Utilisateur';

    /**
     * Fetch all roles.
     * @return array
     */
    public static function findAll(): array
    {
        $roles = [];
        $query = Database::getPDO()->query("SELECT * FROM role");
        if($query) {
            foreach($query->fetchAll() as $roleData) {
                $roles[] = (new Role())
                    ->setId($roleData['id'])
                    ->setRoleName($roleData['role_name'])
                ;
            }
        }
        return $roles;
    }

    /**
     * Return all given user roles.
     * @param User $user
     * @return Role
     */
    public static function getRoleByUser(User $user): Role
    {
        $role = null;
        $rolesQuery = Database::getPDO()->query("
            SELECT * FROM role WHERE id = {$user->getRole()->getId()};
        ");

        if($rolesQuery){
            foreach($rolesQuery->fetchAll() as $roleData) {
                $role = (new Role())
                    ->setId($roleData['id'])
                    ->setRoleName($roleData['role_name'])
                ;
            }
        }

        return $role;
    }


    /**
     * Return all given user roles.
     * @param User $user
     * @return Role
     */
    public static function getRoleById(int$roleId): Role
    {
        $role = null;
        $roleQuery = Database::getPDO()->query("SELECT * FROM role WHERE id = $roleId");

        if($roleQuery){
            $roleData = $roleQuery->fetch();
            $role = (new Role())
                ->setId($roleData['id'])
                ->setRoleName($roleData['role_name'])
            ;
        }

        return $role;
    }


    /**
     * Return a role by name.
     * @param string $roleName
     * @return Role
     */
    public static function getRoleByName(string $roleName): Role
    {
        $role = new Role();
        $rQuery = Database::getPDO()->query("
            SELECT * FROM role WHERE role_name = '".$roleName."'
        ");
        if($rQuery && $roleData = $rQuery->fetch()) {
            $role->setId($roleData['id']);
            $role->setRoleName($roleData['role_name']);
        }
        return $role;
    }

}