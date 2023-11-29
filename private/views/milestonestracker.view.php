<main>
    <div class="add-form">
        <div class="form-section">
            <table style="margin-top: -20px;">
                <thead>
                    <tr>
                        <th>
                            <a href="?tab=1">
                                <button>1 Month</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=2">
                                <button>2 Months</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=4">
                                <button>3-4 Months</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=6">
                                <button>5-6 Months</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=8">
                                <button>7-8 Months</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=10">
                                <button>9-10 Months</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=12">
                                <button>11-12 Months</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=18">
                                <button>18 Months</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=24">
                                <button>2 Years</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=36">
                                <button>3 Years</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=48">
                                <button>4 Years</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=60">
                                <button>5 Years</button>
                            </a>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <a href="<?= ROOT ?>/childrensingle/<?= child_id_URL() ?>">
                                <button>Completed Milestones</button>
                            </a>
                        </th>
                        <th>
                            <a href="<?= ROOT ?>/childrensingle/<?= child_id_URL() ?>">
                                <button>Return</button>
                            </a>
                        </th>
                    </tr>


                </thead>
            </table>
        </div>
    </div>
    <div class="add-form milestone-form">
        <h2>Milestone Tracker</h2>
        <div class="recent-orders">

            <div class="card-group">
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Age Range</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>

                    <?php if ($rows) : ?>
                        <?php foreach ($rows as $row) : ?>
                            <tr>
                                <td><?= $row->name ?></td>
                                <td><?= $row->description ?></td>
                                <td><?= ucfirst(str_replace("_", " ", $row->age_range)) . ' Months' ?></td>
                                <td><?= ucfirst(str_replace("_", " ", $row->category)) ?></td>
                                <td>
                                    <a href="<?= ROOT ?>/milestones/edit/<?= $row->id ?>">
                                        <span class="material-icons-sharp">
                                            edit
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