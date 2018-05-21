<?php
/**
 * Created by PhpStorm.
 * User: hinterreiter
 * Date: 21.05.2018
 * Time: 23:05
 */
foreach ($postings as $posting) : ?>
<li>
    <?php echo $posting->getTitle() ?>
</li>
<?php endforeach;