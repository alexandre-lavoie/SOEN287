<?php
    include(dirname(__FILE__) . "/../../models/backstore-item.php");

    $backstore_items = BackstoreItem::get_samples();
    $backstore_item = $backstore_items[$_GET['id'] - 1];
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
                    <div class="card p-2">
                        <h2>Product Editor</h2>

                        <form class="mb-0" method="POST">
                            <label for="image" class="pb-2">Image</label>
                            <input 
                                value="<?= $backstore_item->item->image ?>" 
                                name="image" 
                                type="url" 
                                id="image" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="name" class="pb-2 pt-2">Name</label>
                            <input 
                                value="<?= $backstore_item->item->name ?>" 
                                name="name" 
                                type="name" 
                                id="name" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="quantity" class="pb-2 pt-2">Quantity</label>
                            <input 
                                value="<?= $backstore_item->quantity ?>" 
                                name="quantity" 
                                type="number" 
                                id="quantity" 
                                min="0"
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <button class="btn btn-success mt-4 mb-0 w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>