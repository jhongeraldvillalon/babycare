<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?= $this->view('includes/crumbs'); ?>
    <div class="card-group">
        <table class="table table-striped table-hover">
            <tr>
                <th>Hospital</th>
                <th>Created by</th>
                <th>Date</th>
                <th>
                    <a href="<?= ROOT ?>/hospitals/add">
                        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
                    </a>
                </th>
            </tr>
        </table>
        <?php if ($rows) : ?>
            <?php foreach ($rows as $row) : ?>

            <?php endforeach; ?>
        <?php else : ?>
            <h5>No hospital data at this time maybe because you did not added any hospital in the database</h5>
        <?php endif; ?>
    </div>


</div>