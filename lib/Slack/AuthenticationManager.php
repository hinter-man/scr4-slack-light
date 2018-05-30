<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 19.05.2018
 * Time: 23:33
 */

namespace Slack;

use Data\DataManager;

class AuthenticationManager extends BaseObject
{

    public static function authenticate(string $userName, string $password): bool
    {
        $user = DataManager::getUserByUserName($userName);

        if ($user != null &&
            $user->getPasswordHash() == $password
        ) {
            $_SESSION['user'] = $user->getId();
            return true;
        }
        self::signOut();
        return false;
    }

    public static function signOut()
    {
        unset($_SESSION['user']);
    }

    public static function isAuthenticated(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function getAuthenticatedUser()
    {
        return self::isAuthenticated() ? DataManager::getUserById($_SESSION['user']) : null;
    }

    public static function createNewUser(string $userName, string $password, $channels) {
        $userId = DataManager::createUser($userName, $password, $channels);
        if ($userId != null && $userId > 0) {
            return DataManager::getUserById($userId);
        }
        return null;
    }

}