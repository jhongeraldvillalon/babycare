<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php // $this->view('includes/crumbs', ['crumbs' => $crumbs]) 
    ?>
    <h5>Children</h5> <br>
    <div class="card-group">
        <table class="table table-striped table-hover">
            <tr>
                <th></th>
                <th>Name</th>
                <th>Created by</th>
                <th>Created Date</th>
                <th>
                    <a href="<?= ROOT ?>/children/add">
                        <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
                    </a>
                </th>
            </tr>

            <?php if ($rows) : ?>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td>
                            <a href="<?= ROOT ?>/child/<?= $row->child_id ?>">
                                <button class="btn btn-sm btn-primary">&nbsp;<i class="fa fa-circle-info"></i></button>
                            </a>
                        </td>
                        <td><?= $row->first_name ?> <?= $row->middle_name ?> <?= $row->last_name ?></td>
                        <td><?php echo $row->user->first_name . " " . $row->user->last_name; ?></td>
                        <td><?= get_date($row->date) ?></td>
                        <td>
                            <a href="<?= ROOT ?>/children/edit/<?= $row->id ?>">
                                <button class="btn-sm btn btn-info text-white"><i class="fa fa-edit"></i></button>
                            </a>
                            <a href="<?= ROOT ?>/children/delete/<?= $row->id ?>">
                                <button class="btn-sm btn btn-danger"><i class="fa fa-trash-alt"></i></button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td></td>
                </tr>
                <h5>No child data at this time</h5>
            <?php endif; ?>

        </table>
    </div>


</div>