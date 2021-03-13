<?php requires_admin() ?>

<?php
    include(dirname(__FILE__) . "/../../models/itemstack.php");
    include(dirname(__FILE__) . "/../../db/aisle.php");

    $itemstacks = [];

    foreach(array_keys($_POST) as $var) {
        if(strpos($var, 'itemstack') === 0) {
            if(empty($_POST[$var])) continue;

            $segments = explode('-', $var);

            $id = $segments[1];

            if(!isset($itemstacks[$id])) {
                $itemstacks[$id] = new ItemStack($id, -1, -1);
            }

            switch($segments[2]) {
                case 'item':
                    $itemstacks[$id]->item = $_POST[$var];
                    break;
                case 'quantity':
                    $itemstacks[$id]->quantity = $_POST[$var];
                    break;
            }
        }
    }

    if(sizeof($itemstacks) > 0) {
        $aisle = current(AisleData::find([$_GET['id']]));

        $aisle->itemstacks = $itemstacks;

        AisleData::update($aisle);
    }


    if(isset($_POST['name'])) {
        if(isset($_GET['id'])) {
            AisleData::_PUT();
        } else {
            AisleData::_POST();
        }
    }

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
                                type="link" 
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
                            <?php include(dirname(__FILE__) . '/../../components/items.php') ?>
                            <button class="btn btn-success mt-4 mb-0 w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>