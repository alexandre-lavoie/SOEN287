<?php
    requires_admin();

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

    if(isset($_POST['name'])) {
        if(isset($_GET['id'])) {
            AisleData::_PUT();
        } else {
            $aisle = AisleData::_POST();

            $_GET['id'] = $aisle->id;
        }
    }

    if(sizeof($itemstacks) > 0) {
        $aisle = current(AisleData::find([$_GET['id']]));

        $aisle->itemstacks = $itemstacks;

        AisleData::update($aisle);
    }

    $json = AisleData::_GET([$_GET['id']]);
    $aisle = current($json->aisles);
    $itemstacks = $aisle->itemstacks;
    $items = $json->items;

    $OBJECT = $aisle;
    $NAME = "Aisle";
    $FIELDS = ['name', 'description', 'image', 'itemstacks'];
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
                    <?php include("../components/admin-editor.php") ?>
                </div>
            </div>
        </div>
    </body>
</html>