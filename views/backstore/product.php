<?php
    requires_admin();

    include(dirname(__FILE__) . "/../../db/item.php");

    if(isset($_POST['price']) && isset($_POST['name'])) {
        if(isset($_GET['id'])) {
            ItemData::_PUT();
        } else {
            ItemData::_POST();
        }
    }

    $item = current(ItemData::find([$_GET['id']]));

    $OBJECT = $item;
    $NAME = "Product";
    $FIELDS = ['name', 'description', 'image', 'price'];
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