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

$channels = DataManager::getChannels();
$title = null;
$text = null;
?>

<?php if (AuthenticationManager::isAuthenticated()) : ?>
    <div class="container-fluid channels">

        <div class="row">
            <div class="col-sm-4">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php
                    foreach ($channels as $channel) : $id = $channel->getId(); ?>
                        <a class="nav-link" id="<?php echo "channel-tab" . $id ?>" data-toggle="pill"
                           href="#<?php echo "channel" . $id ?>" role="tab"
                           aria-controls="<?php echo "channel" . $id ?>"
                           aria-selected="false"><?php echo "#" . $channel->getName() . " - " . $channel->getDescription(); ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="tab-content" id="v-pills-tabContent">
                    <?php
                    $channels = DataManager::getChannels();
                    foreach ($channels as $channel) :
                        $id = $channel->getId();
                        $postings = DataManager::getPostingsByChannel($id);
                        ?>
                        <div class="tab-pane fade" id="<?php echo "channel" . $id ?>" role="tabpanel"
                             aria-labelledby="<?php echo "channel-tab" . $id ?>">
                            <div class="list-group">
                                <?php foreach ($postings as $posting) : ?>
                                    <a href="#"
                                       class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1"><?php echo $posting->getTitle(); ?></h5>
                                            <small><?php echo $posting->getDate(); ?></small>
                                        </div>
                                        <p class="mb-1"><?php echo $posting->getText(); ?></p>
                                        <small><?php echo $posting->getAuthor(); ?></small>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- TODO: Create new posting
                <form method="post" action="slack-light">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">Title</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Title" name="<?php// echo htmlentities($title); ?>" aria-label="Title" aria-describedby="basic-addon1">
                    </div>
                    <button type="submit" class="btn btn-light">Post</button>
                </form>
                -->
            </div>
        </div>
    </div>
<?php else: ?>
    <h1>Please log in or create a new user to see the channels!</h1>
<?php endif ?>


<?php
require_once('views/partials/footer.php');