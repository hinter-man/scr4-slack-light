<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 10:18
 */


require_once('views/partials/header.php');

use Slack\AuthenticationManager;
$authenticated = false;
if (AuthenticationManager::isAuthenticated()) {
    $authenticated = true;
}

?>;

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Channels</title>
</head>
<body>
    <?php if ($authenticated) :?>
        <h1>This is the Channels Section</h1>
    <?php else: ?>
        <h1>Please log in or create a new user to see the channels!</h1>
    <?php endif ?>
</body>
</html>

<?php
require_once('views/partials/footer.php');