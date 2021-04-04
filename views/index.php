<?php
    include_once("../db/aisle.php");
    include_once("../db/splash.php");

    $aisles = array_values(AisleData::find());

    if(count($aisles) === 0) {
        $aisles[] = AisleData::default_data();
    }

    $splash_images = array_values(SplashData::find());

    if(count($splash_images) === 0) {
        $splash_images[] = SplashData::default_data();
    }

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