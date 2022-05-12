<?php

namespace App\Model\Manager;

use App\Model\Database;
use App\Model\Entity\Role;
use User;


final class UserManager
{
    public const TABLE = 'user';
    public const TABLE_USER_ROLE = 'user_role';

    /**
     * Return all available users.
     * @return array
     */
    public static function getAll(): array
    {
        $users = [];
        $result = Database::getPDO()->query("SELECT * FROM " . self::TABLE);

        if($result) {
            foreach ($result->fetchAll() as $data) {
                $users[] = self::makeUser($data);
            }
        }
        return $users;
    }


    /**
     * Return current users count.
     * @return int
     */
    public static function getUsersCount(): int
    {
        $result = Database::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE);
        return $result ? $result->fetch()['cnt'] : 0;
    }

    /**
     * Return current users count.
     * @return int
     */
    public static function getMinAge(): int
    {
        $result = Database::getPDO()->query("SELECT min(age) as minimum FROM " . self::TABLE);
        return $result ? $result->fetch()['minimum'] : 0;
    }


    /**
     * Return a user based on itus id.
     * @param int $id
     * @return User
     */
    public static function getUser(int $id): ?User
    {
        $result = Database::getPDO()->query("SELECT * FROM " . self::TABLE . " WHERE id = $id");
        return $result ? self::makeUser($result->fetch()) : null;
    }

    /**
     * Fetch a user by mail
     * @param string $mail
     * @return User|null
     */
    public static function getUserByMail(string $mail): ?User
    {
        $stmt = Database::getPDO()->prepare("SELECT * FROM " . self::TABLE . " WHERE email = :mail LIMIT 1");
        $stmt->bindParam(':mail', $mail);
        return $stmt->execute() ? self::makeUser($stmt->fetch()) : null;
    }


    /**
     * Check if a user exists.
     * @param int $id
     * @return bool
     */
    public static function userExists(int $id): bool
    {
        $result = Database::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE id = $id");
        return $result ? $result->fetch()['cnt'] : 0;
    }

    /**
     * Check if a user exists with its email.
     * @param int $id
     * @return bool
     */
    public static function userMailExists(string $mail): bool
    {
        $result = Database::getPDO()->query("SELECT count(*) as cnt FROM " . self::TABLE . " WHERE email = \"$mail\"");
        return $result ? $result->fetch()['cnt'] : 0;
    }


    /**
     * Return all available user by given role
     * @param int $roleId
     * @return array
     */
    public static function getUsersByRole(Role $role): array
    {
        $users = [];
        $usersQuery = Database::getPDO()->query("
            SELECT * FROM " . self::TABLE . " WHERE id IN (SELECT user_fk WHERE role_fk = {$role->getId()});
        ");

        if($usersQuery){
            foreach($usersQuery->fetchAll() as $userData) {
                $users[] = self::makeUser($userData);
            }
        }

        return $users;
    }


    /**
     * Delete a user from user db.
     * @param User $user
     * @return bool
     */
    public static function deleteUser(User $user): bool {
        if(self::userExists($user->getId())) {
            return Database::getPDO()->exec("
            DELETE FROM " . self::TABLE . " WHERE id = {$user->getId()}
        ");
        }
        return false;
    }


    /**
     * Create a new User Entity
     * @param array $data
     * @return User
     */
    private static function makeUser(array $data): User
    {
        $user = (new User())
            ->setId($data['id'])
            ->setPassword($data['password'])
            ->setEmail($data['email'])
            ->setLastname($data['lastname'])
            ->setFirstname($data['firstname'])
            ->setAge($data['age'])
        ;

        return $user->setRoles(RoleManager::getRolesByUser($user));
    }


    /**
     * @param User $user
     * @return bool
     */
    public static function addUser(User &$user): bool
    {
        $stmt = Database::getPDO()->prepare("
            INSERT INTO ".self::TABLE." (email, firstname, lastname, password, age) 
            VALUES (:email, :firstname, :lastname, :password, :age)
        ");

        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':lastname', $user->getLastname());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':age', $user->getAge());

        $result = $stmt->execute();
        $user->setId(Database::getPDO()->lastInsertId());
        if($result) {
            $role = RoleManager::getRoleByName(RoleManager::ROLE_USER);
            $resultRole = Database::getPDO()->exec("
                INSERT INTO ".self::TABLE_USER_ROLE. " (user_fk, role_fk) VALUES (".$user->getId().", ".$role->getId().")
            ");

        }
        return $result && $resultRole;
    }


}