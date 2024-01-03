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
                        <thead>
                            <tr>
                                <th>Picture</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Blood Type</th>
                                <th>Gender</th>
                                <th>Birth Date</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:center; ">
                                    <img src="<?= $image ?>" style="height: 150px;">
                                </td>
                                <td><?= esc($row->first_name) ?></td>
                                <td><?= esc($row->middle_name) ?></td>
                                <td><?= esc($row->last_name) ?></td>
                                <td><?= esc($row->blood_type) ?></td>
                                <td><?= esc(ucfirst($row->gender)) ?></td>
                                <td><?= esc(get_date($row->birth_date)) ?></td>
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
                    </table>
                </div>
            </div>
    </div>
    <?php if (!empty($errors)) : ?>
        <div class="errors" style="margin-top: 10px;">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="analyse">
        <div class="searches">
            <a href="<?= ROOT ?>/childprints/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>First Prints</h1>
                        <p>Baby's first prints!</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>CONTACT.png" alt="">
                    </div>
                </div>
            </a>
        </div>
        <div class="searches">
            <a href="<?= ROOT ?>/childrensingle/<?= $row->child_id ?>?tab=staffs">
                <div class="status">
                    <div class="info">
                        <h1>Doctors</h1>
                        <p>Baby's healthcare providers</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>PERSONALS.png" alt="">
                    </div>
                </div>
            </a>
        </div>
        <div class="searches">
            <a href="<?= ROOT ?>/milestonestracker/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Milestones Tracker</h1>
                        <p>Baby's developmental milestones</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>MILESTONES.png" alt="">
                    </div>
                </div>
            </a>
        </div>

        <div class="searches">
            <a href="<?= ROOT ?>/anthropometrics/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Anthropometrics</h1>
                        <p>Baby's physical measurements</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>ANTHROPOMETRICS.png" alt="">
                    </div>
                </div>
            </a>
        </div>

        <?php

            $child = new Anthropometric();
            $exists = $child->first('child_id', $row->child_id);

            if ($exists) : ?>
            <div class="searches">
                <a href="<?= ROOT ?>/growthcharts/<?= $row->child_id ?>">
                    <div class="status">
                        <div class="info">
                            <h1>Growth Chart</h1>
                            <p>Baby's physical measurements</p>
                        </div>
                        <div class="progress">
                            <img src="<?= ASSETS . '/' ?>ANTHROPOMETRICS.png" alt="">
                        </div>
                    </div>
                </a>
            </div>
        <?php else : ?>
        <?php endif; ?>


        <div class="searches">
            <a href="<?= ROOT ?>/contacts/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Contacts</h1>
                        <p>Contact Details or Emergency Contact</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>CONTACT.png" alt="">
                    </div>
                </div>
            </a>
        </div>

        <div class="searches">
            <a href="<?= ROOT ?>/immunizations/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Immunization Records</h1>
                        <p>Your baby's immunization</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>HEALTH_ASSESSMENT.png" alt="">
                    </div>
                </div>
            </a>
        </div>

        <div class="searches">
            <a href="<?= ROOT ?>/healthAssessments/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Health Assessment</h1>
                        <p>Baby's health assessments</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>HEALTH_ASSESSMENT.png" alt="">
                    </div>
                </div>
            </a>
        </div>

        <div class="searches">
            <a href="<?= ROOT ?>/healthLogs/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Health Logs</h1>
                        <p>Health logs of your baby</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>HEALTH_ASSESSMENT.png" alt="">
                    </div>
                </div>
            </a>
        </div>

        <div class="searches">
            <a href="<?= ROOT ?>/dentals/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Dental Records</h1>
                        <p>Teeth Data</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>IMMUNIZATION.png" alt="">
                    </div>
                </div>
            </a>
        </div>
        <div class="searches">
            <a href="<?= ROOT ?>/appointments/<?= $row->child_id ?>">
                <div class="status">
                    <div class="info">
                        <h1>Appointment Scheduling</h1>
                        <p>Appointment</p>
                    </div>
                    <div class="progress">
                        <img src="<?= ASSETS . '/' ?>IMMUNIZATION.png" alt="">
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
            switch ($page_tab) {
                case 'staffs':
                    include(views_path('child_tab_staffs'));
                    break;

                case 'staffs_add':
                    include(views_path('child_tab_staffs_add'));
                    break;

                case 'staffs_remove':
                    include(views_path('child_tab_staffs_remove'));
                    break;

                    // Uncommenting this code will make the feature of adding parents working
                    // case 'parents':
                    //     include(views_path('child_tab_parents'));
                    //     break;

                    // case 'parents_add':
                    //     include(views_path('child_tab_parents_add'));
                    //     break;

                    // case 'parents_remove':
                    //     include(views_path('child_tab_parents_remove'));
                    //     break;

                default:
                    break;
            }
    ?>
<?php else : ?>
    <p>This profile cant be found</p>
<?php endif; ?>



</main>