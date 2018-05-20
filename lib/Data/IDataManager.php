<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 09:05
 */

namespace Data;

interface IDataManager
{
    public static function getUserById(int $userId);

    public static function getUserByUserName(string $userName);

    public static function createUser(string $userName, string $password) : int;

}
