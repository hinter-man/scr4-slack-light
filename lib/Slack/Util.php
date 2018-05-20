<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 19.05.2018
 * Time: 23:36
 */

namespace Slack;

class Util extends BaseObject {

    public static function escape(string $string) : string {
        return nl2br(htmlspecialchars($string));
    }

    public static function action(string $action, array $params = null) : string {
        $url = null;

        $url = 'index.php?' . Controller::ACTION . '=' . rawurlencode($action);

        if (is_array($params)) {
            foreach ($params AS $key => $value) {
                $url .= '&' . rawurlencode($key) . '=' . rawurlencode($value);
            }
        }

        $url .= '&' . Controller::PAGE . '=' . rawurlencode(
                isset($_REQUEST[Controller::PAGE]) ?
                    $_REQUEST[Controller::PAGE] :
                    $_SERVER['REQUEST_URI']
            );

        return $url;
    }

    public static function redirect(string $page = null) {
        if ($page == null) {
            $page = isset($_REQUEST[Controller::PAGE]) ?
                rawurldecode($_REQUEST[Controller::PAGE]) :
                $_SERVER['REQUEST_URI'];
        }
        header("Location: $page");
        exit();
    }

}