<?php
    include("../db/aisle.php");

    $json = AisleData::_GET([$_GET["id"]]);

    $aisle = current($json->aisles);
    $items = array_values($json->items);
    $nav = [
        ['url' => '/', 'name' => 'Home'], 
        ['url' => "/aisle?id=$aisle->id", 'name' => $aisle->name]
    ];
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>
        
        <img class="w-100" style="height: 550px; object-fit: cover;" src="<?= $aisle->image ?>" />

        <?php include("../components/breadcrumb-nav.php") ?>

        <section class="pt-4">
            <div class="container">
                <?php for($y = 0; $y <= sizeof($items) / 3; $y++) { ?>
                        <div class="row">
                            <?php for($x = 0; $x < min(3, sizeof($items) - $y * 3); $x++) { ?>
                                <div class="col-md-4 mb-4 d-flex justify-content-center">
                                    <?php
                                        $i = ($x + $y * 3);

                                        $item = $items[$i];

                                        include("../components/aisle-item.php");
                                    ?>
                                </div>
                            <?php } ?>
                        </div>
                <?php } ?>
            </div>
        </section>
        <?php include("../components/footer.php") ?>
    </body>
</html>