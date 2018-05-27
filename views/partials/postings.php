<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 21.05.2018
 * Time: 23:05
 */


$user = \Slack\AuthenticationManager::getAuthenticatedUser();
?>
<div id="message-list" class="list-group">
    <?php foreach ($postings as $posting) : ?>
        <div id="<?php echo $posting->getId(); ?>"
             class="posting list-group-item list-group-item-action flex-column align-items-start">
            <div id="actualUserId" hidden><?php echo $user->getId(); ?></div>
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?php echo $posting->getTitle(); ?></h5>
                <small><?php echo $posting->getDate(); ?></small>
            </div>
            <p class="mb-1"><?php echo $posting->getText(); ?></p>
            <div class="d-flex w-100 justify-content-between">
                <small><?php echo $posting->getAuthor(); ?></small>
                <button id="important-btn-<?php echo $posting->getId(); ?>"
                        type="submit" class="important-btn
                            <?php echo \Slack\Util::getImportantStyleClass($posting->getImportant()); ?>"/>
                <but
            </div>
        </div>
    <?php endforeach; ?>
    <div class="list-group">
        <div class="list-group-item flex-column align-items-start">
            <form method="post"
                  action="<?php echo \Slack\Util::action(\Slack\Controller::ACTION_NEW_POSTING); ?>">
                <div class form-group>
                    <div class="d-flex w-100 justify-content-between">
                        <input name="<?php print \Slack\Controller::POSTING_TITLE; ?>" type="text"
                               class="form-control"
                               placeholder="Title" maxlength="50" aria-label="Title"
                               aria-describedby="new-posting-title">
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                    <textarea class="form-control" name="<?php print \Slack\Controller::POSTING_TEXT; ?>"
                              aria-label="Message" placeholder="Message"
                              maxlength="250"></textarea>
                    </div>
                    <input type="text" name="<?php print \Slack\Controller::POSTING_CHANNELID; ?>"
                           value="<?php print $channelId; ?>" hidden>
                    <button type="submit" class="btn btn-block">Send</button>
                </div>
            </form>
        </div>

    </div>
</div>
