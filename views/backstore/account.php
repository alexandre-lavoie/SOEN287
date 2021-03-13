<?php requires_admin() ?>

<?php
    include(dirname(__FILE__) . "/../../db/account.php");

    if(isset($_POST['name'])) {
        if(isset($_GET['id'])) {
            AccountData::_PUT();
        } else {
            AccountData::_POST();
        }
    }

    $account = current(AccountData::find([$_GET['id']]));
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
                    <div class="card p-2">
                        <h2>Account Editor</h2>

                        <form class="mb-0" method="POST">
                            <input 
                                id="id"
                                name="id"
                                type="hidden" 
                                value="<?= $_GET['id'] ?>" 
                            />
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