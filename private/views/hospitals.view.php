<main>
    <div class="recent-orders">
        <h2>Hospital</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Hospital</th>
                    <th>Created by</th>
                    <th>Date</th>
                    <th>
                        <a href="<?= ROOT ?>/hospitals/add">
                            Add New
                        </a>
                    </th>
                </tr>
            </thead>
            <?php if ($rows) : ?>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td>
                                <span class="material-icons-sharp">
                                    info
                                </span>
                            </td>
                            <td><?= $row->hospital ?></td>
                            <td><?php echo $row->user->first_name . " " . $row->user->last_name; ?></td>
                            <td><?= get_date($row->date) ?></td>
                            <td>
                                <a href="<?= ROOT ?>/hospitals/edit/<?= $row->id ?>">
                                    <span class="material-icons-sharp">
                                        edit
                                    </span>
                                </a>
                                <a href="<?= ROOT ?>/hospitals/delete/<?= $row->id ?>">
                                    <span class="material-icons-sharp">
                                        delete
                                    </span>
                                </a>
                                <a href="<?= ROOT ?>/switch_hospital/<?= $row->id ?>">
                                    <span class="material-icons-sharp">
                                        check
                                    </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                <?php endif; ?>
                </tbody>
        </table>
    </div>
</main>