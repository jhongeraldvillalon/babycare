<main>
    <div class="recent-orders">
        <div class="add-form">
            <div class="form-section">

                <?php if ($row) { ?>
                    <div class="card-group justify-content-center">
                        <form method="post">
                            <h4>Are you sure you want to delete this hospital?</h4>
                            <input disabled autofocus class="form-control" value="<?= get_var('hospital', $row[0]->hospital) ?>" type="text" name="hospital" placeholder="Hospital Name">
                            <br>
                            <input type="hidden" name="id">
                            <div class="center-button">
                                <button type="submit" value="Delete">Delete</button>
                            </div>
                        </form>
                        <div class="center-button">
                            <a href="<?= ROOT ?>/hospitals">
                                <button value="Cancel">Cancel</button>
                            </a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div style="text-align:center;">
                        <p>That hospital can't be found</p>
                        <a href="<?= ROOT ?>/hospitals">

                            <input class="btn btn-danger text-white" type="button" value="Cancel">
                        </a>
                    </div>
                <?php } ?>

            </div>
</main>