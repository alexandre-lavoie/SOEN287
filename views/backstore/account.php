<?php
    include(dirname(__FILE__) . "/../../models/account.php");

    $accounts = Account::get_samples();
    $account = $accounts[$_GET['id'] - 1];
?>

<?php requires_admin() ?>

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
                    <div class="card p-2">
                        <h2>Account Editor</h2>

                        <form class="mb-0" method="POST">
                            <label for="name" class="pb-2 pt-2">Name</label>
                            <input 
                                value="<?= $account->name ?>" 
                                name="name" 
                                type="name" 
                                id="name" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="email" class="pb-2 pt-2">Email</label>
                            <input 
                                value="<?= $account->email ?>" 
                                name="email" 
                                type="email" 
                                id="email" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="address" class="pb-2 pt-2">Address</label>
                            <input 
                                value="<?= $account->address ?>" 
                                name="address" 
                                type="address" 
                                id="address" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <button class="btn btn-success mt-4 mb-0 w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>