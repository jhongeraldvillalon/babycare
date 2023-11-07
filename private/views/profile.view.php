<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <h1>
        <?= $this->view('includes/crumbs'); ?>
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <img src="assets/user_female.png" class="border border-secondary d-block mx-auto rounded-circle" style="width:100px;">
                <h3 class="text-center">Jhon Gerald Villalon</h3>
            </div>
            <div class="col-sm-8 col-md-9 bg-light p-2">
                <table class="table table-hover table-striped table-bordered">
                    <tr>
                        <th>First Name</th>
                        <td>Jhon Gerald</td>
                    </tr>
                    <tr>
                        <th>Middle Name</th>
                        <td>Israel</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>Villalon</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>Male</td>
                    </tr>
                    <tr>
                        <th>Date Created</th>
                        <td>2023</td>
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

    </h1>
</div>