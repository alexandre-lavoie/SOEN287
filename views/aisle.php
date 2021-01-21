<?php
    include("../models/aisle.php");

    $aisle = Aisle::get_samples()[$_GET["id"] - 1];

    $items = $aisle->items;
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>
        <img class="w-100" style="height: 550px; object-fit: cover;" src="<?= $aisle->image ?>" />

        <nav class="bg-dark pt-3 pb-1">
            <ol class="d-flex justify-content-center breadcrumb">
                <li class="text-white breadcrumb-item"><a href="/">Home</a></li>
                <li class="text-white breadcrumb-item active"><?= $aisle->name ?></li>
            </ol>
        </nav>

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