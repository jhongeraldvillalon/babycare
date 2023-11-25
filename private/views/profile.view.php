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
                            <th>Email</th>
                            <td><?= esc($row->email) ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?= esc(ucfirst($row->gender)) ?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?= esc(ucwords(str_replace("_", " ", $row->user_role))) ?></td>
                        </tr>
                        <tr>
                            <th>Date Created</th>
                            <td><?= get_date($row->date) ?></td>
                        </tr>
                        <tr>
                            <th>Contact</th>
                            <td><?= esc($row->contact) ?></td>
                        </tr>
                        <tr>
                            <th>
                                Actions
                            </th>
                            <td>
                                <a href="<?= ROOT ?>/">
                                    <button style="padding: 0.8rem 1.4rem;
    background-color: var(--color-primary);
    color: var(--color-white);
    border: none;
    border-radius: var(--border-radius-1);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;" value="Cancel">Home</button>
                                </a>
                                <a href="<?= ROOT ?>/profile/edit/<?= $row->user_id ?>">
                                    <button style="padding: 0.8rem 1.4rem;
    background-color: var(--color-primary);
    color: var(--color-white);
    border: none;
    border-radius: var(--border-radius-1);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;" value="Cancel">Edit</button>
                                </a>
                                <a href="<?= ROOT ?>/profile/delete/<?= $row->user_id ?>">
                                    <button style="padding: 0.8rem 1.4rem;
    background-color: var(--color-primary);
    color: var(--color-white);
    border: none;
    border-radius: var(--border-radius-1);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;" value="Cancel">Delete</button>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="recent-orders">
                <h5>Managing Children</h5> <br>
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

                        <?php $rows = $data['child_parents'];

                        if (isset($rows) && $rows) : ?>
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
                                        <?php if (Auth::isAdmin() || Auth::isParent()) : ?>
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
                                        <?php endif; ?>
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
        <?php else : ?>
            <p>This profile cant be found</p>
        <?php endif; ?>
    </div>
</main>