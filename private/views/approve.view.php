<main>
    <?php if (Auth::isAdmin()) :  ?>
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
                            <a href="<?= ROOT ?>/">
                                <button value="Cancel">Cancel</button>
                            </a>
                        </th>
                    </thead>
                </table>
            </div>
        </div>
    <?php endif; ?>
    <div class="recent-orders">


        <h5>Unapprove Staffs</h5> <br>
        <div class="card-group">
            <table>
                <tr>
                    <th>Name</th>

                    <th>Created Date</th>
                    <th>Gender</th>
                    <th>Occupation Applying</th>
                    <th>
                        ID
                    </th>
                    <th>Approve
                    </th>
                </tr>

                <?php if ($rows) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row->first_name ?> <?= $row->middle_name ?> <?= $row->last_name ?></td>
                            <td><?= get_date($row->date) ?></td>
                            <td><?= ucfirst(str_replace("_", " ", $row->gender)) ?></td>
                            <td><?= ucfirst(str_replace("_", " ", $row->user_role)) ?></td>
                            <td>
                                <?php if (!empty($row->id_card)) : ?>
                                    <img src="data:image/png;base64,<?= $row->id_card ?>" alt="ID Card">
                                <?php else : ?>
                                    No ID Card
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= ROOT ?>/approve/edit/<?= $row->id ?>">
                                    <span class="material-icons-sharp">
                                        check
                                    </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td></td>
                    </tr>
                    <!-- <h5>No child data at this time</h5> -->
                <?php endif; ?>

            </table>
        </div>
    </div>
</main>