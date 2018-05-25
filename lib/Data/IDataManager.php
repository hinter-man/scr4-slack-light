<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 09:05
 */

namespace Data;

use Slack\Posting;
use Slack\User;

interface IDataManager
{
    public static function getUserById(int $userId);

    public static function getUserByUserName(string $userName);

    public static function createUser(string $userName, string $password) : int;

    public static function getChannels() : array;

    public static function getPostingsByChannel(int $channelId) : array;

    public static function createPosting(int $channelId, string $title, string $text, User $user) : int;

}
