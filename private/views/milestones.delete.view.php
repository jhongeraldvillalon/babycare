<main>
    <div class="add-form">
        <div class="form-section">
            <?php if ($row) { ?>
                <div class="card-group justify-content-center">
                    <form method="post">
                        <h4>Are you sure you want to delete this milestone?</h4>
                        <input disabled autofocus class="form-control" value="<?= get_var('name', $row[0]->name) ?>" type="text" name="name" placeholder="Name">
                        <br>
                        <input type="hidden" name="id">
                        <button type="submit" value="Save">Yes</button>
                        <a href="<?= ROOT ?>/milestones">
                            <input class="cancel" type="button" value="Cancel">
                        </a>
                    </form>
                </div>
            <?php } else { ?>
                <div style="text-align:center;">
                    <p>That child can't be found</p>
                    <a href="<?= ROOT ?>/milestones">
                        <input class="cancel" type="button" value="Cancel">
                    </a>
                </div>
            <?php } ?>

        </div>
    </div>
</main>