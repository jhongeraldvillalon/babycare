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
    <?php $pager->display(); ?>

    <div class="new-users">
        <div class="user-list">
            <?php
 
            if ($rows) : ?>
                <?php foreach ($rows as $row) :
                    
                    if(Auth::isAdmin()  || Auth::i_own_content($row)) :
                    ?>
                    
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
                <?php endif;  endforeach; ?>
            <?php else : ?>

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