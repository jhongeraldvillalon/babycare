<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php if ($row) { ?>
        <div class="card-group justify-content-center">
            <form method="post">
                <h4>Are you sure you want to delete this hospital?</h4>

                <input disabled autofocus class="form-control" value="<?= get_var('hospital', $row[0]->hospital) ?>" type="text" name="hospital" placeholder="Hospital Name">
                <br>
                <input type="hidden" name="id">
                <input class="btn btn-danger float-end" type="submit" value="Delete">
                <a href="<?= ROOT ?>/hospitals">
                    <input class="btn btn-success text-white" type="button" value="Cancel">
                </a>
            </form>

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