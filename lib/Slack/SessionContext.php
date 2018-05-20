<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 19.05.2018
 * Time: 23:36
 */

namespace Slack;

class SessionContext extends BaseObject
{
    private static $exists;

    public static function create(): bool
    {
        if (!self::$exists) {
            self::$exists = session_start();
        }
        return self::$exists;
    }
}
