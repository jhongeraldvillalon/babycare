<table style="margin-top: 20px;">
    <thead>
        <th style="padding-right: 500px; width: 2000px;">
            <input type="text" placeholder="Search">
        </th>
        <th style="padding-right: 20px; width: 1000px;">
            <a href="<?= ROOT ?>/childrensingle/parents_add/<?= $row->child_id ?>?select=true">
                <button value="Add">Add parent</button>
            </a>
        </th>

        <th style="padding-right: 20px; width: 1000px;">
            <a href="<?= ROOT ?>/childrensingle/parents_remove/<?= $row->child_id ?>?select=true">
                <button value="Add">Remove Staff</button>
            </a>
        </th>

    </thead>
</table>
<?php $pager->display(); ?>
<div class="analyse">
    <?php if (is_array($parents)) : ?>

        <?php foreach ($parents as $parent) : ?>
            <?php

            $row = $parent->user;
            include(views_path("user"));

            ?>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No parent were found in this child</p>
    <?php endif; ?>
</div>