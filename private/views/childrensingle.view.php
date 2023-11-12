<main>
    <br>
    <div class="recent-orders">
        <?php if ($row) : ?>
            <div class="row">
                <div>
                    <?php
                    $image = get_image($row->image, $row->gender);
                    ?>
                </div>
                <div>
                    <table>

                        <tr>
                            <th></th>
                            <td>
                                <img src="<?= $image ?>" style="width:100px;">
                            </td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><?= esc($row->first_name) ?></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><?= esc($row->last_name) ?></td>
                        </tr>
                        <tr>
                            <th>Blood Type</th>
                            <td><?= esc($row->blood_type) ?></td>
                        </tr>
                        <tr>
                            <th>Mother</th>
                            <td><?= esc($row->mother) ?></td>
                        </tr>
                        <tr>
                            <th>Father</th>
                            <td><?= esc($row->father) ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?= esc(ucfirst($row->gender)) ?></td>
                        </tr>
                        <tr>
                            <th>Birth Date</th>
                            <td><?= esc(get_date($row->birth_date)) ?></td>
                        </tr>
                        <tr>
                            <th>Date Created</th>
                            <td><?= get_date($row->date) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="add-form">
                <table style="margin-top: -20px;">
                    <thead>
                        <th>

                        </th>
                    </thead>
                </table>
                <tbody>
                    <tr>
                        <th>
                            <form>
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                            <a href="<?= ROOT ?>/parents">
                                <button value="Cancel">Back</button>
                            </a>
                        </th>
                        <th>

                        </th>
                    </tr>

                    </tr>
                    <th>
                        <a href="#">Basic Info</a>
                    </th>
                    <th>
                        <a href="#">Classes</a>
                    </th>
                    <th>
                        <a href="#">Tests</a>
                    </th>
                    </tr>

                </tbody>
            </div>
        <?php else : ?>
            <p>This profile cant be found</p>
        <?php endif; ?>
    </div>
</main>