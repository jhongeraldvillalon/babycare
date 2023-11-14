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
                <table>
                    <thead>
                        <tr>
                            <th>
                                <a href="<?= ROOT ?>/childrensingle/<?= $row->child_id ?>?tab=staffs">
                                    <button value="staff">Assigned Staff</button>
                                </a>
                            </th>
                            <th>
                                <a href="<?= ROOT ?>/childrensingle/<?= $row->child_id ?>?tab=parents">
                                    <button value="parents">Parents</button>
                                </a>
                            </th>
                            <th>
                                <a href="<?= ROOT ?>/health_records/<?= $row->child_id ?>">
                                    <button value="health_record"> Health Record</button>
                                </a>
                            </th>
                            <th style="padding-right: 20px;">
                                <a href="<?= ROOT ?>/children">
                                    <button value="Cancel">Return</button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <br>
                    <tbody>

                    </tbody>
                </table>

                <?php

                switch ($page_tab) {
                    case 'staffs':
                        include(views_path('child-tab-staffs'));
                        break;
                    case 'parents':
                        include(views_path('child-tab-parents'));
                        break;

                    case 'staffs-add':
                        include(views_path('child-tab-staffs-add'));
                        break;
                    case 'parents-add':
                        include(views_path('child-tab-parents-add'));
                        break;
                    default:

                        break;
                }

                ?>

            </div>
        <?php else : ?>
            <p>This profile cant be found</p>
        <?php endif; ?>
    </div>
</main>