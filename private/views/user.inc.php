<div class="searches">
    <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>">
        <div class="status">
            <div class="info">
                <h1><?= $row->first_name ?> <?= $row->last_name ?></h1>
                <p><?= str_replace("_", " ", $row->user_role) ?></p>
            </div>
            <div class="progress">
                <?php
                $image = get_image($row->image, $row->gender);
                ?>
                <img src="<?= $image ?>" alt="">
            </div>
            <?php if (isset($_GET['select'])) : ?>
                <button name="selected" value="<?= $row->user_id ?>">Select</button>
            <?php endif; ?>
        </div>
    </a>
</div>