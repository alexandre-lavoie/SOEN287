<?php
    include_once("../models/item.php");

    $item = Item::get_samples()[$_GET["id"] - 1];
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>

        <nav class="bg-dark pt-3 pb-1">
            <ol class="d-flex justify-content-center breadcrumb">
                <li class="text-white breadcrumb-item"><a href="/">Home</a></li>
                <li class="text-white breadcrumb-item"><a href="/aisle?id=1">Aisle</a></li>
                <li class="text-white breadcrumb-item active"><?= $item->name ?></li>
            </ol>
        </nav>

        <section class="p-2" style="min-height: 78vh">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-4 pb-2">
                        <div class="card d-flex justify-content-center">
                            <img style="object-fit: cover;" src="<?= $item->image ?>"/>
                        </div>
                    </div>
                    <div class="col-12 col-md-8 pb-2">
                        <div class="card p-3">
                            <h4><?= $item->name ?></h4>
                            <h4 class="text-success">$<?= $item->price ?></h4>
                            <p><?= $item->description ?></p>
                            <?php
                                $quantity = 1;

                                include("../components/quantity-selector.php")
                            ?>
                            <br />
                            <button class="btn btn-success" onclick="location.href = '/cart';"><i class="bi bi-cart2"></i> Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include("../components/footer.php") ?>
    </body>
</html>