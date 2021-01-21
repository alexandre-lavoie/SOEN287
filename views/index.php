<?php
    include("../models/aisle.php");
    include("../models/splash-image.php");

    $aisles = Aisle::get_samples();
    $splash_images = SplashImage::get_samples();
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>
        <?php include("../components/carousel.php") ?>
        <nav class="navbar bg-dark justify-content-center py-3">
            <span class="text-white">Home</span>
        </nav>
        <section class="pt-4">
            <div class="container">
                <?php for($y = 0; $y < 3; $y++) { ?>
                        <div class="row">
                            <?php for($x = 0; $x < 3; $x++) { ?>
                                <div class="col-md-4 mb-4 d-flex justify-content-center">
                                    <?php
                                        $i = ($x + $y * 2) % sizeof($aisles);

                                        $aisle = $aisles[$i];

                                        include("../components/aisle-card.php");
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