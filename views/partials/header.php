<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 08:44
 */

use Slack\Util;
use Slack\AuthenticationManager;
use Slack\Controller;

$user = AuthenticationManager::getAuthenticatedUser(); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>Slack Light</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="assets/main.css" rel="stylesheet">
    <!--
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">

    -->
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/slack-light">Slack-light</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?view=channels">Channels</a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right my-2 my-lg-0">
            <li class="nav-item dropdown">
                <?php if ($user == null): ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Not logged in!
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?view=login">Login now</a>
                        <a class="dropdown-item" href="index.php?view=new-user">New user</a>
                    </div>
                <?php else: ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "Hello, " . Util::escape($user->getUserName()); ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <form method="post"
                              action="<?php echo Util::action(Slack\Controller::ACTION_LOGOUT); ?>">
                            <input class="dropdown-item" role="button" type="submit" value="Logout"/>
                        </form>
                    </div>

                <?php endif; ?>

            </li>
        </ul> <!-- /. login -->
    </div>
</nav>


<!-- Success Messages -->
<div class="container">
    <?php
    $type = $_SESSION[Controller::USER_LOGIN_FEEDBACK] ?? null;
    switch ($type) {
        case Controller::USER_LOGIN_SUCCESS:
            ?>
            <div class="alert alert-success">
                <strong>User successfully created!</strong> Please login to continue.
            </div>
            <?php
            break;
    }
    ?>

    <!-- Error Messages -->

    <?php switch ($type) {
        case Controller::USER_ALREADY_EXISTS:
            ?>
            <div class="alert alert-danger">
                <strong>User already exists!</strong> Please try again.
            </div>
            <?php
            break;
        case Controller::USER_INVALID_CREDENTIALS:
            ?>
            <div class="alert alert-danger">
                <strong>Invalid credentials</strong> Please try again.
            </div>
            <?php
            break;
    }
    ?>


    <?php unset($_SESSION[Controller::USER_LOGIN_FEEDBACK]); ?>
</div>

<div class="container">

