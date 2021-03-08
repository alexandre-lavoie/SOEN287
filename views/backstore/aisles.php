<?php
    include(dirname(__FILE__) . "/../../db/aisle.php");

    $aisles = array_values(AisleData::find());
?>

<?php requires_admin() ?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/admin-header.php") ?>

        <div class="p-2">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-2 pb-2">
                    <?php include(dirname(__FILE__) . "/../../components/admin-nav.php") ?>
                </div>
                <div class="col-12 col-md-8 col-lg-10 pb-2">
                    <div class="card p-2 mb-2">
                        <input class="form-control" placeholder="Search" />
                        <a class="mt-2 no-dec" href="/backstore/account">
                            <button class="btn btn-success" style="width: 100%">Create</button>
                        </a>
                    </div>
                    <div class="card p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($aisles as $aisle) { ?>
                                        <tr>
                                            <td><?= $aisle->id ?></td>
                                            <td><img style="max-width: 75px" src="<?= $aisle->image ?>"></td>
                                            <td><?= $aisle->name ?></td>
                                            <td><?= $aisle->description ?></td>
                                            <td>
                                                <a class="m-2 no-dec" href="/backstore/aisle?id=<?= $aisle->id ?>">
                                                    <button class="btn btn-success">Edit</button>
                                                </a>
                                                <a class="no-dec" href="/backstore/aisle?id=<?= $aisle->id ?>">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>