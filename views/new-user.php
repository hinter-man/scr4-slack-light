<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 10:36
 */

use Slack\AuthenticationManager;
use Slack\Util;

if (AuthenticationManager::isAuthenticated()) {
    Util::redirect("index.php?view=channels");
}

$userName = isset($_REQUEST['userName']) ? $_REQUEST['userName'] : null;

require_once('views/partials/header.php'); ?>

    <div class="page-header">
        <h2>New User</h2>
    </div>

    <form method="post"
          action="<?php echo Util::action(Slack\Controller::ACTION_NEW_USER, array('view' => $view)); ?>">
        <div class="form-group">
            <label for="inputName" class="control-label">User name</label>
            <input type="text" class="col-sm-4 form-control" id="inputName"
                   name="<?php print Slack\Controller::USER_NAME; ?>" placeholder="Enter username"
                   value="<?php echo htmlentities($userName); ?>">

        </div>
        <div class="form-group">
            <label for="inputPassword" class="control-label">Password</label>
            <input type="password" class="col-sm-4 form-control" id="inputPassword"
                   name="<?php print Slack\Controller::USER_PASSWORD; ?>" placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-light">Create new user</button>

    </form>


<?php
require_once('views/partials/footer.php');


