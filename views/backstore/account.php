<?php 
    include_once(dirname(__FILE__) . "/../../models/account.php");
    include_once(dirname(__FILE__) . "/../../db/account.php");

    if(isset($_POST['name'])) {
        if(isset($_GET['id'])) {
            AccountData::_PUT();
        } else {
            AccountData::_POST();
        }
    }

    $OBJECT = current(AccountData::find([$_GET['id']]));
    $NAME = "Account";
    $FIELDS = ['name', 'email', 'address'];

    if(!isset($_GET['id'])) {
        $FIELDS[] = 'password';
    }
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