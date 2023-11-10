<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
        <?= $this->view('includes/crumbs'); ?>
        <a href="<?= ROOT ?>/signup">
                <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
        </a>
        <div class="card-group">
                <?php if ($rows) : ?>

                        <?php foreach ($rows as $row) : ?>
                                <div class="card m-1" style="max-width: 14rem;min-width: 14rem;">
                                        <img src="assets/user_female.png" class="card-img-top">
                                        <div class="card-body shadow">
                                                <h5 class="card-title"><?= $row->first_name ?> <?= $row->last_name ?></h5>
                                                <p class="card-text"><?= str_replace("_", " ", $row->user_role) ?></p>
                                                <a href="#" class="btn btn-primary">Profile</a>
                                        </div>
                                </div>
                        <?php endforeach; ?>
                <?php else : ?>
                        <p>No staff at this time</p>
                <?php endif; ?>
        </div>
</div>