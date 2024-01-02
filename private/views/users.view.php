<?php if (Auth::isAdmin()) :  ?>
        <main>
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
                                                        <a href="<?= ROOT ?>/signup">
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
                                        <?php include(views_path("user")); ?>
                                <?php endforeach; ?>
                        <?php else : ?>
                                <!-- <p>No staff at this time</p> -->
                        <?php endif; ?>
                </div>
        </main>
<?php endif;  ?>