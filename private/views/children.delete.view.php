<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php if ($row) { ?>
        <div class="card-group justify-content-center">
            <form method="post">
                <h4>Are you sure you want to delete this child?</h4>
                <input disabled autofocus class="form-control" value=
                "<?= get_var('first_name', $row[0]->first_name) ?> <?= get_var('middle_name', $row[0]->middle_name) ?> <?= get_var('last_name', $row[0]->last_name) ?>"
                 type="text" name="first_name" placeholder="Name">

                <br>
                <input type="hidden" name="id">
                <input class="btn btn-danger float-end" type="submit" value="Delete">
                <a href="<?= ROOT ?>/children">
                    <input class="btn btn-success text-white" type="button" value="Cancel">
                </a>
            </form>
        </div>
    <?php } else { ?>
        <div style="text-align:center;">
            <p>That child can't be found</p>
            <a href="<?= ROOT ?>/children">

                <input class="btn btn-danger text-white" type="button" value="Cancel">
            </a>
        </div>
    <?php } ?>

</div>