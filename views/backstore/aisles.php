<?php
    include(dirname(__FILE__) . "/../../db/aisle.php");

    $aisles = AisleData::find();

    if(isset($_POST['delete'])) {
        $id = $_POST['delete'];

        if(AisleData::delete($id)) {
            unset($aisles[$id]);
        }
    }

    $aisles = array_values(AisleData::find());

    $URL = "/backstore/aisle";
?>

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
                    <?php include(dirname(__FILE__) . "/../../components/admin-create-section.php") ?>
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
                                                <?php
                                                    $ID = $aisle->id;

                                                    include(dirname(__FILE__) . "/../../components/admin-table-buttons.php");
                                                ?>
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