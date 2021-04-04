<?php
    requires_admin();

    include(dirname(__FILE__) . "/../../db/order.php");

    $json = OrderData::_GET();
    $orders = $json->orders;
    $accounts = $json->accounts;

    if(isset($_POST['delete'])) {
        $id = $_POST['delete'];

        if(OrderData::delete($id)) {
            unset($orders[$id]);
        }
    }

    $URL = "/backstore/order";
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
                    <?php include(dirname(__FILE__) . "/../../components/admin-create-section.php") ?>
                    <div class="card p-2">
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Address</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orders as $order) { ?>
                                        <tr>
                                            <td><?= $order->id?></td>
                                            <td><?= $order->time?></td>
                                            <td><?= $accounts[$order->account]->address?></td>
                                            <td>
                                                <?php
                                                    $ID = $order->id;

                                                    include(dirname(__FILE__) . "/../../components/admin-table-buttons.php");
                                                ?>
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