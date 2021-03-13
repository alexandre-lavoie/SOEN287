<?php
    requires_admin();

    include(dirname(__FILE__) . "/../../db/item.php");

    $products = ItemData::find();

    if(isset($_POST['delete'])) {
        $id = $_POST['delete'];

        if(ItemData::delete($id)) {
            unset($products[$id]);
        }
    }
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
                    <div class="card p-2 mb-2">
                        <input class="form-control" placeholder="Search" />
                        <a class="mt-2 no-dec" href="/backstore/product">
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
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($products as $product) { ?>
                                        <tr>
                                            <td><?= $product->id ?></td>
                                            <td><img style="max-width: 75px" src="<?= $product->image ?>"/></td>
                                            <td><?= $product->name ?></td>
                                            <td>
                                                <a class="m-2 no-dec" href="/backstore/product?id=<?= $product->id ?>">
                                                    <button class="btn btn-success">Edit</button>
                                                </a>
                                                <form method="POST" style="display: inline">
                                                    <input id="delete" name="delete" type="hidden" value="<?= $product->id ?>"/>
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
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