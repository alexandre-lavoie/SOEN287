<?php
    include(dirname(__FILE__) . "/../../models/order.php");

    $orders = Order::get_samples();
    $order = $orders[$_GET['id'] - 1];
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
                        <h2>Order Editor</h2>

                        <form class="mb-0" method="POST">
                            <label for="date" class="pb-2">Date</label>
                            <input 
                                value="<?= explode(" ", $order->time)[0] ?>" 
                                name="date" 
                                type="date" 
                                id="date" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="time" class="pb-2 pt-2">Time</label>
                            <input 
                                value="<?= explode(" ", $order->time)[1] ?>" 
                                name="time" 
                                type="time" 
                                id="time" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="account" class="pb-2 pt-2">Account ID</label>
                            <input 
                                value="<?= $order->account->id ?>" 
                                name="account" 
                                type="id" 
                                id="account" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="items" class="pb-2 pt-2">Items</label>
                            <div class="table-responsive">
                                <table class="table table-bordered m-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($order) { ?>
                                            <?php foreach($order->cart_items as $cart_item) { ?>
                                                <tr>
                                                    <td>
                                                        <input
                                                            class="form-control"
                                                            required="" 
                                                            autofocus=""
                                                            value="<?= $cart_item->item->id?>"
                                                        />
                                                    </td>
                                                    <td>
                                                        <input
                                                            class="form-control"
                                                            required="" 
                                                            autofocus=""
                                                            value="<?= $cart_item->quantity?>"
                                                        />
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php }?>
                                        <tr>
                                            <td>
                                                <input
                                                    class="form-control"
                                                    value=""
                                                />    
                                            </td>
                                            <td>
                                                <input
                                                    class="form-control"
                                                    value=""
                                                />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-success mt-4 mb-0 w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>