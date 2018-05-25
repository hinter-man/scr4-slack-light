<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 20.05.2018
 * Time: 10:18
 */


require_once('views/partials/header.php');

use Slack\AuthenticationManager;
use Data\DataManager;
use Slack\Controller;

$channels = DataManager::getChannels();

if (!isset($user)) {
    $user = AuthenticationManager::getAuthenticatedUser();
}

$channelId = $_REQUEST['channelId'] ?? null;
if (isset($channelId) && $channelId > 0) {
    $postings = DataManager::getPostingsByChannelByUser($channelId, $user->getId());
}
?>

<?php if (AuthenticationManager::isAuthenticated()) : ?>
    <div class="container-fluid channels">

        <div class="row">
            <div class="col-sm-4">
                <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                    <?php
                    foreach ($channels as $channel) : $id = $channel->getId();
                        $unread = DataManager::getAmountOfUnreadPostingsByChannelByUser($id, $user->getId()); ?>
                        <a class="nav-link" id="<?php echo "channel-tab" . $id ?>"
                           href="<?php echo $_SERVER['PHP_SELF'] ?>?view=channels&channelId=<?php echo urlencode($id); ?>"
                           role="tab">
                            <?php echo "#" . $channel->getName() . " - " . $channel->getDescription();
                            if ($unread > 0) :?>
                                <span class="badge badge-primary badge-pill"><?php echo $unread ?></span>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-sm-8">
                <?php if (isset($channelId)) :
                    if (sizeof($postings) <= 0) : ?>
                        <div class="alert alert-warning" role="alert">
                            No postings in this channel!
                        </div>
                    <?php endif;
                    require("partials/postings.php"); ?>
                <?php else : ?>
                    <div class="alert alert-info" role="alert">
                        Please select a channel
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php else: ?>
    <h1>Please log in or create a new user to see the channels!</h1>
<?php endif ?>


<?php
require_once('views/partials/footer.php');