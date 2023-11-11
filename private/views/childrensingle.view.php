<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <?php if ($row) : ?>
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <?php
                $image = get_image($row->user->image, $row->gender);
                ?>
                <img src="<?= $image ?>" class="d-block mx-auto" style="width:100px;">
                <h3 class="text-center"><?= esc($row->first_name) ?> <?= esc($row->last_name) ?></h3>
            </div>
            <div class="col-sm-8 col-md-9 bg-light p-2">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>First Name</th>
                        <td><?= esc($row->first_name) ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?= esc($row->last_name) ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?= esc(ucfirst($row->gender)) ?></td>
                    </tr>
                    <tr>
                        <th>Date Created</th>
                        <td><?= get_date($row->date) ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="container-fluid">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Basic Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Classes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tests</a>
                </li>
            </ul>
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">&nbsp<i class="fa-solid fa-magnifying-glass"></i>&nbsp</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
                    </div>
                </form>
            </nav>
        </div>

    <?php else : ?>
        <p>This child cant be found</p>
    <?php endif; ?>


</div>