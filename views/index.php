<?php
    include("../db/aisle.php");
    include("../db/splash.php");

    $aisles = array_values(AisleData::find());
    $splash_images = array_values(SplashData::find());
    $nav = [
        ['url' => '/', 'name' => 'Home']
    ];
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>
        <?php include("../components/carousel.php") ?>
        <?php include("../components/breadcrumb-nav.php") ?>

        <section class="pt-4">
            <div class="container">
                <?php for($y = 0; $y < sizeof($aisles) / 3; $y++) { ?>
                        <div class="row">
                            <?php for($x = 0; $x < min(3, sizeof($aisles) - $y * 3); $x++) { ?>
                                <div class="col-md-4 mb-4 d-flex justify-content-center">
                                    <?php
                                        $i = $x + $y * 3;

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