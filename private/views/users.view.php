<main>
        <div class="add-form">
                <div class="form-section">
                        <table style="margin-top: -20px;">
                                <thead>
                                        <th style="padding-right: 500px; width: 2000px;">
                                                <input type="text" placeholder="Search">
                                        </th>
                                        <th style="padding-right: 20px;">
                                                <a href="<?= ROOT ?>/signup">
                                                        <button value="Add">Add</button>
                                                </a>
                                        </th>
                                        <th>
                                                <a href="<?= ROOT ?>/users">
                                                        <button value="Cancel">Cancel</button>
                                                </a>
                                        </th>
                                </thead>
                        </table>
                </div>
        </div>
        <br>
        <div class="analyse">
                <?php if ($rows) : ?>
                        <?php foreach ($rows as $row) : ?>
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
                                                </div>
                                        </a>
                                </div>
                        <?php endforeach; ?>
                <?php else : ?>
                        <!-- <p>No staff at this time</p> -->
                <?php endif; ?>
        </div>
</main>