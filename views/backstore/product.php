<?php requires_admin() ?>

<?php
    include(dirname(__FILE__) . "/../../db/item.php");

    if(isset($_POST['name'])) {
        if(isset($_GET['id'])) {
            ItemData::_PUT();
        } else {
            ItemData::_POST();
        }
    }

    $item = current(ItemData::find([$_GET['id']]));
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
                    <div class="card p-2">
                        <h2>Product Editor</h2>

                        <form class="mb-0" method="POST">
                            <input 
                                id="id"
                                name="id"
                                type="hidden" 
                                value="<?= $_GET['id'] ?>" 
                            />
                            <label for="image" class="pb-2">Image</label>
                            <input 
                                value="<?= $item->image ?>" 
                                name="image" 
                                type="url" 
                                id="image" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="name" class="pb-2 pt-2">Name</label>
                            <input 
                                value="<?= $item->name ?>" 
                                name="name" 
                                type="name" 
                                id="name" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="price" class="pb-2 pt-2">Price</label>
                            <input 
                                value="<?= $item->price ?>" 
                                name="price" 
                                type="price" 
                                id="price" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="description" class="pb-2 pt-2">Description</label>
                            <input 
                                value="<?= $item->description ?>" 
                                name="description" 
                                type="description" 
                                id="description" 
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