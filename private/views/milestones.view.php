<main>
    <?php if (Auth::isAdmin()) :  ?>
        <div class="add-form">
            <div class="form-section">
                <table style="margin-top: -20px;">
                    <thead>
                        <form>
                            <th>
                                <button name="submit"><i class="fa fa-search"></i></button>
                            </th>
                            <th style="padding-right: 500px; width: 2000px;">
                                <input value="<?= isset($_GET['find']) ? $_GET['find'] : '' ?>" type="text" name="find" placeholder="Search">
                            </th>
                        </form>
                        <th style="padding-right: 20px;">
                            <a href="<?= ROOT ?>/milestones/add">
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
    <?php $pager->display(); ?>

    <div class="recent-orders">
        <h5>Milestones</h5> <br>
        <div class="card-group">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Age Range</th>
                    <th>Disabled</th>
                    <th>Actions</th>
                </tr>

                <?php if ($rows) : ?>
                    <?php foreach ($rows as $row) : ?>
                        <tr>
                            <td><?= $row->name ?></td>
                            <td><?= $row->description ?></td>
                            <td><?= ucfirst(str_replace("_", " ", $row->age_range)) . ' Months' ?></td>
                            <td><?= ucfirst(str_replace("_", " ", $row->disabled)) ?></td>
                            <td>
                                <a href="<?= ROOT ?>/milestones/edit/<?= $row->id ?>">
                                    <span class="material-icons-sharp">
                                        edit
                                    </span>
                                </a>
                                <a href="<?= ROOT ?>/milestones/delete/<?= $row->id ?>">
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
                    <!-- <h5>No milestone data at this time</h5> -->
                <?php endif; ?>

            </table>
        </div>
    </div>
</main>