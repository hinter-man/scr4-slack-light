<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 19.05.2018
 * Time: 23:28
 */

//declare(strict_types=1);
error_reporting(E_ALL);
ini_set("display_errors", 1);

spl_autoload_register(
    function ($class) {
        $filepath = __DIR__ . '/../lib/' .
            str_replace('\\', DIRECTORY_SEPARATOR, $class) .
            '.php';
        if (file_exists($filepath)) {
            include($filepath);
        }
    }
);

// create session
Slack\SessionContext::create();

require_once(__DIR__ . '/../lib/Data/DataManager_mysqlpdo.php');