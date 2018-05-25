<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 25.05.2018
 * Time: 17:45
 */
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
require_once(__DIR__ . '/../lib/Data/DataManager_mysqlpdo.php');

use Slack\Controller;
use Data\DataManager;

$action = $_REQUEST['action'] ?? null;
if (isset($action) && $action == Controller::ACTION_TOGGLE_IMPORTANT) {
    $postingId = $_REQUEST[Controller::POSTING_ID];
    $userId = $_REQUEST[Controller::USER_ID];
    DataManager::togglePostingImportant($postingId, $userId);
    // TODO return either true of false for important state
    echo "hello";
}



