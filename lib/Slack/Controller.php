<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 19.05.2018
 * Time: 23:37
 */


namespace Slack;

use Data\DataManager;

/**
 * Controller
 *
 * class handles POST requests and redirects
 * the client after processing
 * - demo of singleton pattern
 */
class Controller
    extends BaseObject
{
    // static strings used in views

    const ACTION = 'action';
    const PAGE = 'page';
    const ACTION_LOGIN = 'login';
    const ACTION_LOGOUT = 'logout';
    const ACTION_NEW_USER = 'new-user';
    const ACTION_NEW_POSTING = 'new-posting';
    const ACTION_TOGGLE_IMPORTANT = 'toggle-important';
    const USER_NAME = 'userName';
    const USER_PASSWORD = 'password';
    const USER_LOGIN_FEEDBACK = 'user-login-feedback';
    const USER_INVALID_CREDENTIALS = 'invalid-credentials';
    const USER_LOGIN_SUCCESS = 'login-success';
    const USER_ALREADY_EXISTS = 'already-exists';
    const POSTING_TITLE = 'posting-title';
    const POSTING_TEXT = 'posting-text';
    const POSTING_CHANNELID = 'posting-channelId';
    const POSTING_ID = 'postingId';
    const USER_ID = 'userId';

    private static $instance = false;

    /**
     *
     * @return Controller
     */
    public static function getInstance(): Controller
    {

        if (!self::$instance) {
            self::$instance = new Controller();
        }

        return self::$instance;
    }

    private function __construct()
    {

    }

    /**
     *
     * processes POST requests and redirects client depending on selected
     * action
     *
     * @return bool
     * @throws \Exception
     */
    public function invokePostAction(): bool
    {

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            throw new \Exception('Controller can only handle POST requests.');

            return null;
        } elseif (!isset($_REQUEST[self::ACTION])) {
            throw new \Exception(self::ACTION . ' not specified.');

            return null;
        }


        // now process the assigned action
        $action = $_REQUEST[self::ACTION];

        switch ($action) {
            case self::ACTION_LOGIN :
                if (!AuthenticationManager::authenticate($_REQUEST[self::USER_NAME], $_REQUEST[self::USER_PASSWORD])) {
                    $_SESSION[self::USER_LOGIN_FEEDBACK] = self::USER_INVALID_CREDENTIALS;
                    Util::redirect();
                }
                Util::redirect();
                break;

            case self::ACTION_LOGOUT :
                AuthenticationManager::signOut();
                Util::redirect("index.php");
                break;

            case self::ACTION_NEW_USER:
                $user = AuthenticationManager::createNewUser($_REQUEST[self::USER_NAME], $_REQUEST[self::USER_PASSWORD]);
                if ($user != null) {
                    $_SESSION[self::USER_LOGIN_FEEDBACK] = self::USER_LOGIN_SUCCESS;
                    Util::redirect("index.php?view=login");
                } else {
                    $_SESSION[self::USER_LOGIN_FEEDBACK] = self::USER_ALREADY_EXISTS;
                    Util::redirect();
                }

                break;

            case self::ACTION_NEW_POSTING:
                $user = AuthenticationManager::getAuthenticatedUser();
                $posting = DataManager::createPosting($_REQUEST[self::POSTING_CHANNELID], $_REQUEST[self::POSTING_TITLE], $_REQUEST[self::POSTING_TEXT], $user);
                if ($posting == null) {
                    throw new \Exception("Posting could not have been created!");
                } else {
                    Util::redirect();
                }
                break;

            default :
                throw new \Exception('Unknown controller action: ' . $action);
                break;
        }
    }


}