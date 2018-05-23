<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 21.05.2018
 * Time: 23:05
 */

?>
<div class="list-group">
    <?php foreach ($postings as $posting) : ?>

        <div class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?php echo $posting->getTitle(); ?></h5>
                <small><?php echo $posting->getDate(); ?></small>
            </div>
            <p class="mb-1"><?php echo $posting->getText(); ?></p>
            <small><?php echo $posting->getAuthor(); ?></small>
        </div>
    <?php endforeach; ?>

    <div class="list-group-item flex-column align-items-start">
        <div>
            <form>
                <div class="d-flex w-100 justify-content-between">
                    <input type="text" class="form-control" placeholder="Title" maxlength="50" aria-label="Title"
                           aria-describedby="new-posting-title">
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <textarea class="form-control" aria-label="Message" placeholder="Message"
                              maxlength="250"></textarea>
                </div>
            </form>
        </div>
    </div>

</div>