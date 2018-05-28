<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 28.05.2018
 * Time: 15:07
 */


?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit posting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post" action="<?php echo \Slack\Util::action(\Slack\Controller::ACTION_EDIT_POSTING); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-form-label">Title</label>
                        <input type="text" name="<?php print \Slack\Controller::POSTING_TITLE; ?>" class="form-control"
                               maxlength="50" id="title">
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-form-label">Text</label>
                        <textarea class="form-control" name="<?php print \Slack\Controller::POSTING_TEXT; ?>"
                                  maxlength="250" id="text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button id="save-edit-btn" type="submit" name="<?php print \Slack\Controller::POSTING_ID; ?>"
                            class="btn btn-light">Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
