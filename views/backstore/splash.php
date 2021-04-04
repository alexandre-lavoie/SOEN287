<?php 
    include_once(dirname(__FILE__) . "/../../db/splash.php");

    if(isset($_POST['name'])) {
        if(isset($_GET['id'])) {
            SplashData::_PUT();
        } else {
            SplashData::_POST();
        }
    }

    $OBJECT = current(SplashData::find([$_GET['id']]));
    $NAME = 'Splash';
    $FIELDS = ['name', 'description', 'image'];
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