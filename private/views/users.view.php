<?php if (Auth::isAdmin()) :  ?>
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

                                        </thead>
                                </table>
                        </div>
                </div>
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
<main>

</main>