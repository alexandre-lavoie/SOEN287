<?php
    include_once("../db/account.php");

    if($_POST['email'] && $_POST['password']) {
        $account = AccountData::_POST();

        $_SESSION['accountID'] = $account->id;

        redirect('/backstore');
    }
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
    </head>
    <body class="bg-light">
        <br/><br/>
        <h3 style="text-align: center">Hello World</h3>
        <h5 style="text-align: center">Create an admin account to get started.</h5>
        <br/><br/>

        <div class="d-flex justify-content-center align-items-center container">
            <div class="row">
                <div class="col">
                    <?php include("../components/signup-form.php") ?>
                </div>
            </div>
        </div>
    </body>
</html>