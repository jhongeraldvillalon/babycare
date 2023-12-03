<main>
    <div class="add-form">
        <div class="form-section">
            <table style="margin-top: -20px;">
                <thead>
                    <tr>
                        <th>
                            <a href="?tab=completed">
                                <button>Completed</button>
                            </a>
                        </th>
                        <th>
                            <a href="?tab=goals">
                                <button>Goals</button>
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
                        <th>Age Range</th>
                        <th>Category</th>
                        <th>Actions</th>

                    </tr>

                    <?php if ($rows) : ?>

                        <?php foreach ($rows as $row) : ?>
                            <form id="milestoneForm_<?= $row->milestone_id ?>" action="<?= ROOT ?>/milestonestracker/add/<?= child_id_URL() ?>" method="POST">
                                <input type="hidden" value="<?= $row->milestone_id ?>" name="milestone_id"> <!-- Include the hidden input for milestone_id -->
                                <tr>
                                    <td><?= $row->name ?></td>
                                    <td><?= ucfirst(str_replace("_", " ", $row->age_range)) . ' Months' ?></td>
                                    <td><?= ucfirst(str_replace("_", " ", $row->category)) ?></td>


                                    <td>
                                        <input type="hidden" value="<?= child_id_URL() ?>" name="child_id">
                                        <?php
                                        $isChecked = false;

                                        // Check if $milestoneTrackerRow is iterable (array or object)
                                        if (is_iterable($milestoneTrackerRow)) {
                                            foreach ($milestoneTrackerRow as $tracker) {
                                                if ($tracker->milestone_id == $row->milestone_id && $tracker->accomplished) {
                                                    $isChecked = true;
                                                    break;
                                                }
                                            }
                                        }
                                        ?>
                                        <input type="checkbox" name="milestone_id" class="milestone-checkbox" value="<?= $row->milestone_id ?>" <?= $isChecked ? 'checked' : '' ?>>

                                    </td>
                                </tr>
                            </form>
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
    </div>
</main>
<script>
    const checkboxes = document.querySelectorAll('.milestone-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const formId = 'milestoneForm_' + this.value;
            const form = document.getElementById(formId);

            if (form) {
                if (this.checked) {
                    form.submit();
                } else {
                    const uncheckInput = document.createElement('input');
                    uncheckInput.type = 'hidden';
                    uncheckInput.name = 'accomplished';
                    uncheckInput.value = '0';

                    form.appendChild(uncheckInput);
                    form.submit();

                    // Remove the appended input after form submission
                    form.removeChild(uncheckInput);
                }
            }
        });
    });
</script>