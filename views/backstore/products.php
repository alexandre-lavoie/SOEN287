<?php
    include(dirname(__FILE__) . "/../../models/backstore-item.php");

    $backstore_items = BackstoreItem::get_samples();
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
                        <button class="btn btn-success mt-2">Create</button>
                    </div>
                    <div class="card p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($backstore_items as $backstore_item) { ?>
                                        <tr>
                                            <td><?= $backstore_item->id ?></td>
                                            <td><img style="max-width: 75px" src="<?= $backstore_item->item->image ?>"/></td>
                                            <td><?= $backstore_item->item->name ?></td>
                                            <td><?= $backstore_item->quantity ?></td>
                                            <td><button class="m-2 btn btn-success">Edit</button><button class="btn btn-danger">Delete</button></td>
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