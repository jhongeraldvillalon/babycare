<main>
    <?php if (Auth::isAdmin()) :  ?>
        <div class="add-form">
            <div class="form-section">
                <table style="margin-top: -20px;">
                    <thead>
                        <th style="padding-right: 500px; width: 2000px;">
                            <input type="text" placeholder="Search">
                        </th>
                        <th style="padding-right: 20px;">
                            <a href="<?= ROOT ?>/children/add">
                                <button value="Add">Add</button>
                            </a>
                        </th>
                        <th>
                            <a href="<?= ROOT ?>/">
                                <button value="Cancel">Cancel</button>
                            </a>
                        </th>
                    </thead>
                </table>
            </div>
        </div>
    <?php endif; ?>

    <div class="new-users">
        <div class="user-list">
            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>
                    <a href="<?= ROOT ?>/childrensingle/<?= $row->child_id ?>">
                        <div class="user">
                            <?php if (!empty($row->id_card)) : ?>
                                <img src="<?= get_image($row->id_card, $row->gender); ?>" height="150 em" width="auto" alt="ID Card">
                            <?php else : ?>
                                <img src="<?php echo ASSETS . "/baby.png"; ?>" alt="">
                            <?php endif; ?>

                            <h2><?= $row->first_name ?> <?= $row->middle_name ?> <?= $row->last_name ?></h2>
                            <p><?= ucfirst(str_replace("_", " ", $row->gender)) ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else : ?>
                <!-- <p>No staff at this time</p> -->
            <?php endif; ?>
            <a href="<?= ROOT ?>/children/add">
                <div class="user">
                    <img src="<?php echo ASSETS . "/add.png"; ?>" alt="">
                    <h2>Add</h2>
                    <p>Add New Baby</p>
                </div>
            </a>
        </div>
    </div>
</main>