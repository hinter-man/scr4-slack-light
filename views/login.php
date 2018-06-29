<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 08:43
 */

use Slack\AuthenticationManager;
use Slack\Util;

if (AuthenticationManager::isAuthenticated()) {
    Util::redirect("index.php?view=channels");
}


$userName = isset($_REQUEST['userName']) ? $_REQUEST['userName'] : null;

?>

<?php require_once('views/partials/header.php'); ?>

    <div class="page-header">
        <h2>Login</h2>
    </div>

    <form method="post" action="<?php echo Util::action(Slack\Controller::ACTION_LOGIN, array('view' => $view)); ?>">
        <div class="form-group">
            <label for="inputName">Username</label>
            <input type="text" class="col-sm-4 form-control" id="inputName" maxlength="30"
                   name="<?php print Slack\Controller::USER_NAME; ?>"
                   value="<?php echo htmlentities($userName); ?>" placeholder="Enter username" required>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="col-sm-4 form-control" id="inputPassword" maxlength="40"
                   name="<?php print Slack\Controller::USER_PASSWORD; ?>" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-light">Login</button>
    </form>

<?php
require_once('views/partials/footer.php');