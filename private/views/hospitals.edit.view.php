<main>
    <div class="recent-orders">
        <div class="add-form">
            <div class="form-section">
                <h2>Edit Hospital</h2>
                <?php if ($row) { ?>
                    <div>
                        <form method="post">
                            <h4>Hospital</h4>
                            <?php if (count($errors) > 0) : ?>
                                <div>
                                    <strong>Oops</strong>
                                    <?php foreach ($errors as $error) : ?>
                                        <br> <?= $error ?>
                                    <?php endforeach; ?>
                                    <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <div class="form-row">
                                <div class="form-column">
                                    <input autofocus class="form-control" value="<?= get_var('hospital', $row[0]->hospital) ?>" type="text" name="hospital" placeholder="Hospital Name">
                                </div>
                            </div>
                            <br>
                            <div class="center-button">
                                <button type="submit" value="Save">Save</button>
                            </div>
                            <div class="center-button">
                                <a href="<?= ROOT ?>/hospitals">
                                    <button value="Cancel">Cancel</button>
                                </a>
                            </div>
                        </form>
                    </div>
                <?php } else { ?>
                    <div style="text-align:center;">
                        <p>That hospital can't be found</p>
                        <a href="<?= ROOT ?>/hospitals">

                            <input type="button" value="Cancel">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
        </form>
    </div>
</main>