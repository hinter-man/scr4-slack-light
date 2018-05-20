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
    <?php $userCreated = $_SESSION['success-user'] ?? null;
        if (isset($userCreated) && !$userCreated) : ?>
        <div class="alert alert-danger">
            <strong>Username already exists!</strong> Please choose another one.
        </div>
    <?php unset($_SESSION['success-user']); endif ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            Please fill out the form below:
        </div>
        <div class="panel-body">

            <form class="form-horizontal" method="post"
                  action="<?php echo Util::action(Slack\Controller::ACTION_NEW_USER, array('view' => $view)); ?>">
                <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">User name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="inputName"
                               name="<?php print Slack\Controller::USER_NAME; ?>" placeholder="username"
                               value="<?php echo htmlentities($userName); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="inputPassword"
                               name="<?php print Slack\Controller::USER_PASSWORD; ?>" placeholder="password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-6">
                        <button type="submit" class="btn btn-default">Create New User</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

<?php
require_once('views/partials/footer.php');


