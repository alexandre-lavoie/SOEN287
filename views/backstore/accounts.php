<?php
    requires_admin();

    include(dirname(__FILE__) . "/../../db/account.php");

    $accounts = AccountData::find();

    if(isset($_POST['delete'])) {
        $id = $_POST['delete'];

        if(AccountData::delete($id)) {
            unset($accounts[$id]);
        }
    }

    $accounts = array_values($accounts);
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
                    <div class="card p-2 mb-2">
                        <input class="form-control" placeholder="Search" />
                        <a class="mt-2 no-dec" href="/backstore/account">
                            <button class="btn btn-success" style="width: 100%">Create</button>
                        </a>
                    </div>
                    <div class="card p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Address</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($accounts as $account) { ?>
                                        <tr>
                                            <td><?= $account->id ?></td>
                                            <td><?= explode(" ", $account->name)[0] ?></td>
                                            <td><?= explode(" ", $account->name)[1] ?></td>
                                            <td><?= $account->email ?></td>
                                            <td><?= $account->address ?></td>
                                            <td>
                                                <a class="m-2 no-dec" href="/backstore/account?id=<?= $account->id ?>">
                                                    <button class="btn btn-success">Edit</button>
                                                </a>
                                                <form method="POST" style="display: inline">
                                                    <input id="delete" name="delete" type="hidden" value="<?= $account->id ?>"/>
                                                    <button class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>