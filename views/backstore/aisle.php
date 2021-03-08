<?php requires_admin() ?>

<?php
    include(dirname(__FILE__) . "/../../db/aisle.php");

    $json = AisleData::_GET([$_GET['id']]);
    $aisle = current($json->aisles);
    $itemstacks = $aisle->itemstacks;
    $items = $json->items;
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
                        <h2>Aisle Editor</h2>

                        <form class="mb-0" method="POST">
                            <input 
                                id="id"
                                name="id"
                                type="hidden" 
                                value="<?= $_GET['id'] ?>" 
                            />
                            <label for="image" class="pb-2">Image</label>
                            <input 
                                value="<?= $aisle->image ?>" 
                                name="image" 
                                type="url" 
                                id="image" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="name" class="pb-2 pt-2">Name</label>
                            <input 
                                value="<?= $aisle->name ?>" 
                                name="name" 
                                type="name" 
                                id="name" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="description" class="pb-2 pt-2">Description</label>
                            <input 
                                value="<?= $aisle->description ?>" 
                                name="description" 
                                type="description" 
                                id="description" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="items" class="pb-2 pt-2">Items</label>
                            <div class="table-responsive">
                                <table class="table table-bordered m-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($order) { ?>
                                            <?php foreach($cart->itemstacks as $itemstack) { ?>
                                                <tr>
                                                    <td>
                                                        <input
                                                            class="form-control"
                                                            required="" 
                                                            autofocus=""
                                                            value="<?= $itemstack->id?>"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            class="form-control"
                                                            required="" 
                                                            autofocus=""
                                                            value="<?= $itemstack->quantity?>"
                                                        />
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php }?>
                                        <tr>
                                            <td>
                                                <input
                                                    class="form-control"
                                                    value=""
                                                />    
                                            </td>
                                            <td>
                                                <input
                                                    class="form-control"
                                                    value=""
                                                />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success mt-4 mb-0 w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>