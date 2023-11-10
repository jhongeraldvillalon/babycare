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

            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $row->hospital ?></td>
                        <td><?php echo $row->user->first_name . " " . $row->user->last_name; ?></td>
                        <td><?= get_date($row->date) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/hospitals/edit/<?= $row->id ?>">
                                <button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/hospitals/delete/<?= $row->id ?>">
                                <button class="btn-sm btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <h5>No hospital data at this time maybe because you did not added any hospital in the database</h5>
            <?php endif; ?>

        </table>
    </div>


</div>