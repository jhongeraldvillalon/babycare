<main>
    <?php if (Auth::isAdmin()) :  ?>
        <div class="add-form">
            <div class="form-section">
                <table style="margin-top: -20px;">
                    <thead>
                        <form>
                            <th>
                                <button name="submit"><i class="fa fa-search"></i></button>
                            </th>
                            <th style="padding-right: 500px; width: 2000px;">
                                <input value="<?= isset($_GET['find']) ? $_GET['find'] : '' ?>" type="text" name="find" placeholder="Search">
                            </th>
                        </form>
                        <th style="padding-right: 20px;">
                            <a href="<?= ROOT ?>/signup?mode=parents">
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
        <?php $pager->display(); ?>
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
                <p>No results</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</main>