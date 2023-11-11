<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <nav class="navbar navbar-light bg-light">
        <form class="form-inline">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">&nbsp<i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
                </div>
                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
            </div>
        </form>
        <a href="<?= ROOT ?>/signup?mode=parents">
            <button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>Add New</button>
        </a>
    </nav>

    <div class="card-group">
        <?php if ($rows) : ?>

            <?php foreach ($rows as $row) : ?>
                <?php
                $image = get_image($row->image, $row->gender);
                ?>
                <div class="card m-1" style="max-width: 14rem;min-width: 14rem;">
                    <img src="<?= $image ?>" class="card-img-top">
                    <div class="card-body shadow">
                        <h5 class="card-title"><?= $row->first_name ?> <?= $row->last_name ?></h5>
                        <p class="card-text"><?= str_replace("_", " ", $row->user_role) ?></p>
                        <a href="<?= ROOT ?>/profile/<?= $row->user_id ?>" class="btn btn-primary">Profile</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <center>
                <p>No parents at this time</p>
            </center>
        <?php endif; ?>
    </div>
</div>