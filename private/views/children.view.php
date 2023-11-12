<main>
    <div class="add-form">
        <div class="form-section">
            <table style="margin-top: -20px;">
                <thead>
                    <th style="padding-right: 500px; width: 2000px;">
                        <input type="text" placeholder="Search">
                    </th>
                    <th style="padding-right: 20px;">
                        <a href="<?= ROOT ?>/children/add">
                            <button value="Add">Add</button>
                        </a>
                    </th>
                    <th>
                        <a href="<?= ROOT ?>/hospitals">
                            <button value="Cancel">Cancel</button>
                        </a>
                    </th>
                </thead>
            </table>
        </div>
    </div>

    <div class="recent-orders">


        <h5>Children</h5> <br>
        <div class="card-group">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Created by</th>
                    <th>Created Date</th>
                    <th>Gender</th>
                    <th>
                    </th>
                </tr>

                <?php if ($rows) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row->first_name ?> <?= $row->middle_name ?> <?= $row->last_name ?></td>
                            <td><?php echo $row->user->first_name . " " . $row->user->last_name; ?></td>
                            <td><?= get_date($row->date) ?></td>
                            <td><?= ucfirst(str_replace("_", " ", $row->gender)) ?></td>
                            <td>
                                <a href="<?= ROOT ?>/childrensingle/<?= $row->child_id ?>">
                                    <span class="material-icons-sharp">
                                        info
                                    </span>
                                </a>
                                <a href="<?= ROOT ?>/children/edit/<?= $row->id ?>">
                                    <span class="material-icons-sharp">
                                        edit
                                    </span>
                                </a>
                                <a href="<?= ROOT ?>/children/delete/<?= $row->id ?>">
                                    <span class="material-icons-sharp">
                                        delete
                                    </span>
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
</main>