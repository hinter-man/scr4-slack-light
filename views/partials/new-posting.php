<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 25.05.2018
 * Time: 10:47
 */
use Data\DataManager;
use Slack\AuthenticationManager;

$action = $_POST['action'] ?? null;
if (!isset($postings) && $action == 'new-posting') {
    $postingChannelId = $_POST['posting-channelId'];
    $postingTitle = $_POST['posting-title'];
    $postingText = $_POST['posting-text'];
    $postingUser = AuthenticationManager::getAuthenticatedUser();

    echo $postingChannelId;
    echo $postingTitle;
    echo $postingText;
    echo $postingUser->getUserName();
    DataManager::createPosting($postingChannelId, $postingTitle, $postingText, $postingUser);
    $postings = DataManager::getPostingsByChannel($postingChannelId);
}

?>

<div class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1"><?php var_dump($posting) ?></h5>
        <small>xxxx</small>
    </div>
    <p class="mb-1">ccccc</p>
    <small>cccvbdfgd</small>
</div>