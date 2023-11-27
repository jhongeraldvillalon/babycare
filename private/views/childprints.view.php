<?php

// Check if there's a record in the database for the current child ID
// Get the current URL path
$current_url = $_SERVER['REQUEST_URI'];

// Split the URL path by '/'
$url_parts = explode('/', $current_url);

// The child_id will be the last part of the URL
$current_child_id = end($url_parts);

$child_print_model = new ChildPrint();
$existing_print = $child_print_model->first('child_id', $current_child_id);


if ($existing_print) :
?>
    <main>
        <div class="add-form milestone-form">
            <h2>First Prints</h2>
            <div class="form-section">

                <div class="form-row">
                    <div class="form-column picture-column">
                        <?php if (!empty($existing_print->left_hand)) : ?>
                            <label for="">Left Hand Print</label>
                            <img style="width:200px; height:200px; margin-left:15%;" src="<?= get_image($existing_print->left_hand); ?>" alt="Left Hand Print Image">
                        <?php else : ?>
                            No Image
                        <?php endif; ?>
                    </div>

                    <div class="form-column picture-column">
                        <?php if (!empty($existing_print->right_hand)) : ?>
                            <label for="">Right Hand Print</label>
                            <img style="width:200px; height:200px; margin-left:15%;" src="<?= get_image($existing_print->right_hand); ?>" alt="Right Hand Print Image">
                        <?php else : ?>
                            No Image
                        <?php endif; ?>
                    </div>
                    <div class="form-column picture-column">
                        <?php if (!empty($existing_print->left_foot)) : ?>
                            <label for="">Left Foot Print</label>
                            <img style="width:200px; height:200px; margin-left:15%;" src="<?= get_image($existing_print->left_foot); ?>" alt="Left Foot Print Image">
                        <?php else : ?>
                            No Image
                        <?php endif; ?>

                    </div>
                    <div class="form-column picture-column">
                        <?php if (!empty($existing_print->right_foot)) : ?>
                            <label for="">Right Foot Print</label>
                            <img style="width:200px; height:200px; margin-left:15%;" src="<?= get_image($existing_print->right_foot); ?>" alt="Right Foot Print Image">
                        <?php else : ?>
                            No Image
                        <?php endif; ?>
                    </div>
                </div>
            </div>

    </main>
<?php else : ?>
    <main>

        <div class="add-form milestone-form">
            <h2>First Prints</h2>
            </p>
            <div class="form-section">
                <form method="post" enctype="multipart/form-data" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to submit? Upon submitting you can no longer change this.');">
                    <?php if (count($errors) > 0) : ?>
                        <div class="alert alert-warning alert-dismissible fade show p-0" role="alert">
                            <strong>Oops</strong>
                            <?php foreach ($errors as $error) : ?>
                                <br> <?= $error ?>
                            <?php endforeach; ?>
                            <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </span>
                        </div>
                    <?php endif; ?>
                    <div class="form-row">

                        <div class="form-column picture-column">
                            <label for="left_hand">Left Handprint</label>
                            <div class="form-input-picture">
                                <input type="file" onchange="display_image_name(this.files[0].name)" id="left_hand" name="left_hand" required>
                            </div>
                        </div>
                        <div class="form-column picture-column">
                            <label for="right_hand">Right Handprint</label>
                            <div class="form-input-picture">
                                <input type="file" onchange="display_image_name(this.files[1].name)" id="right_hand" name="right_hand" required>
                            </div>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-column picture-column">
                            <label for="left_foot">Left Footprint</label>
                            <div class="form-input-picture">
                                <input type="file" onchange="display_image_name(this.files[2].name)" id="left_foot" name="left_foot" required>
                            </div>
                        </div>
                        <div class="form-column picture-column">
                            <label for="right_foot">Right Footprint</label>
                            <div class="form-input-picture">
                                <input type="file" onchange="display_image_name(this.files[3].name)" id="right_foot" name="right_foot" required>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="center-button">
                <button>Save</button>
            </div>
            </form>
        </div>

    <?php endif; ?>
    </main>

    <script>
        function display_image_name(file_name) {
            document.querySelector(".file_info").innerHTML = file_name;
        }
    </script>