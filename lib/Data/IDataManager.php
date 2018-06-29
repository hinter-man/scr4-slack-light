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

    public static function createUser(string $userName, string $password, array $channels) : int;

    public static function getChannels() : array;

    public static function getUserChannels(int $userId) : array;

    public static function getPostingsByChannelByUser(int $channelId, int $userId, $markAsRead) : array;

    public static function getAmountOfUnreadPostingsByChannelByUser(int $channelId, int $userId) : int;

    public static function markPostingsAsRead($channelId, $userId);

    /**
     * Toggle posting important flag
     *
     * @param $postingId
     * @param $userId
     * @return mixed
     */
    public static function togglePostingImportant($postingId, $userId);

    public static function createPosting(int $channelId, string $title, string $text, User $user) : int;

    public static function deletePosting(int $postingId, User $user): int;

    public static function editPosting(int $postingId, string $title, string $text, User $user) : int;

}
