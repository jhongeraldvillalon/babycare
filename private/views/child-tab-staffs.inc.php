<table style="margin-top: 20px;">
    <thead>
        <th style="padding-right: 500px; width: 2000px;">
            <input type="text" placeholder="Search">
        </th>
        <th style="padding-right: 20px; width: 1000px;">
            <a href="<?= ROOT ?>/childrensingle/<?= $row->child_id ?>?tab=staffs-add&select=true">
                <button value="Add">Add Staff</button>
            </a>
        </th>

        <th style="padding-right: 20px; width: 1000px;">
            <a href="<?= ROOT ?>/childrensingle/<?= $row->child_id ?>?tab=staffs-remove&select=true">
                <button value="Add">Remove Staff</button>
            </a>
        </th>

    </thead>
</table>
<div class="analyse">
    <?php if (is_array($staffs)) : ?>

        <?php foreach ($staffs as $staff) : ?>
            <?php

            $row = $staff->user;
            include(views_path("user"));

            ?>
        <?php endforeach; ?>


    <?php endif; ?>
</div>