<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 09:06
 */

namespace Data;

use Slack\Channel;
use Slack\Posting;
use Slack\User;

include 'IDataManager.php';


class DataManager implements IDataManager
{

    private static $__connection;

    private static function getConnection()
    {

        if (!isset(self::$__connection)) {

            $type = 'mysql';
            $host = 'localhost';
            $name = 'fh_2018_scm4_s1610307018';
            $user = 'root';
            $pass = '';

            self::$__connection = new \PDO(
                $type . ':host=' . $host . ';dbname=' . $name . ';charset=utf8', $user, $pass
            );
        }

        return self::$__connection;
    }

    public static function exposeConnection()
    {
        return self::getConnection();
    }

    private static function query($connection, $query, $parameters = array())
    {

        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        try {

            $statement = $connection->prepare($query);
            $i = 1;

            foreach ($parameters AS $param) {

                if (is_int($param)) {
                    $statement->bindValue($i, $param, \PDO::PARAM_INT);
                }
                if (is_string($param)) {
                    $statement->bindValue($i, $param, \PDO::PARAM_STR);
                }

                $i++;
            }

            $result = $statement->execute();


        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $statement;

    }

    private static function lastInsertId($connection)
    {
        return $connection->lastInsertId();
    }

    private static function fetchObject($cursor)
    {
        return $cursor->fetchObject();
    }

    private static function close($cursor)
    {
        $cursor->closeCursor();
    }

    private static function closeConnection($connection)
    {
        self::$__connection = null;
    }


    public static function getUserById(int $userId)
    {
        $user = null;

        $con = self::getConnection();
        $res = self::query($con, "
			SELECT Id, Username, Password
			FROM user
			WHERE id = ?;
		", [$userId]);

        if ($u = self::fetchObject($res)) {
            $user = new User($u->Id, $u->Username, $u->Password);
        }

        self::close($res);
        self::closeConnection($con);

        return $user;
    }

    public static function getUserByUserName(string $userName)
    {
        $user = null;

        $con = self::getConnection();
        $res = self::query($con, "
			SELECT Id, Username, Password
			FROM user
			WHERE Username = ?;
		", [$userName]);

        if ($u = self::fetchObject($res)) {
            $user = new User($u->Id, $u->Username, $u->Password);
        }

        self::close($res);
        self::closeConnection($con);

        return $user;
    }

    public static function createUser(string $userName, string $password): int
    {
        $userId = null;

        // check if user already exists
        $user = self::getUserByUserName($userName);
        if ($user != null) {
            return -1;
        }

        $con = self::getConnection();
        $con->beginTransaction();
        try {
            self::query($con,
                "INSERT INTO user (Username, Password) 
                      VALUES (?, ?)",
                array($userName,
                    $password));

            $userId = self::lastInsertId($con);
            $con->commit();

        } catch (\Exception $e) {
            $con->rollBack();
            $userId = -1;
        }

        self::closeConnection($con);
        return $userId;
    }

    public static function getChannels(): array
    {
        $channels = array();

        $con = self::getConnection();
        $res = self::query($con, "
			SELECT * FROM channel");

        while ($channel = self::fetchObject($res)) {
            $channels[] = new Channel($channel->Id, $channel->Name, $channel->Description);
        }

        self::close($res);
        self::closeConnection($con);

        return $channels;
    }

    public static function getPostingsByChannel(int $channelId): array
    {
        $postings = array();

        $con = self::getConnection();
        $res = self::query($con, "
			SELECT * FROM posting WHERE ChannelId = ?", array($channelId));

        while ($posting = self::fetchObject($res)) {
            $postings[] = new Posting($posting->Id, $posting->ChannelId, $posting->Title, $posting->Text, $posting->Author, $posting->Date);
        }

        self::close($res);
        self::closeConnection($con);

        return $postings;
    }

    public static function createPosting(int $channelId, string $title, string $text, User $user): int
    {
        $postingId = null;

        $con = self::getConnection();
        $con->beginTransaction();
        try {
            self::query($con, "INSERT INTO posting (ChannelId, Title, Text, Author, Date) VALUES (?, ?, ?, ?, ?)",
                array($channelId, $title, $text, $user->getUserName(), date("Y/m/d")));

            $postingId = self::lastInsertId($con);

            self::query($con, "INSERT INTO userposting (UserId, ChannelId, PostingId, `Read`, Important, Deleted) VALUES (?, ?, ?, ?, ?, ?)",
                array($user->getId(), $channelId, $postingId, 0, 0, 0));
            $con->commit();

        } catch (\Exception $e) {
            $con->rollBack();
            $postingId = -1;
        }

        self::closeConnection($con);
        return $postingId;
    }
}



















