<main>
    <br>
    <div class="recent-orders">
        <h3>Edit Profile</h3>
        <?php if ($row) : ?>
            <div class="row">

                <?php
                $image = get_image($row->image, $row->gender);
                ?>

                <div>
                    <div>

                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Image
                                </th>
                                <th>Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="<?= $image ?>" style="width:100px;">
                                </td>
                                <td><?= esc($row->first_name) ?></td>

                                <td><?= esc($row->last_name) ?></td>
                                <td><?= esc($row->email) ?></td>
                                <td><?= esc(ucfirst($row->gender)) ?></td>
                                <td><?= esc(ucwords(str_replace("_", " ", $row->user_role))) ?></td>
                                <td><?= get_date($row->date) ?></td>
                                <td>
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
                                    <a href="<?= ROOT ?>/children">
                                        <span class="material-icons-sharp">
                                            keyboard_return
                                        </span>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                        <tr>

                            <td>

                            </td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Date Created</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>
                                Actions
                            </th>
                            <td>
                              N  <a href="<?= ROOT ?>/">
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


        <?php else : ?>
            <p>This profile cant be found</p>
        <?php endif; ?>
    </div>
</main>