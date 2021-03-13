<?php requires_admin() ?>

<?php
    include(dirname(__FILE__) . "/../../models/itemstack.php");
    include(dirname(__FILE__) . "/../../db/cart.php");
    include(dirname(__FILE__) . "/../../db/order.php");

    if(isset($_POST['time']) && isset($_POST['date'])) {
        $_POST['time'] = $_POST['date'] . ' ' . $_POST['time'];
    }

    $itemstacks = [];

    foreach(array_keys($_POST) as $var) {
        if(strpos($var, 'itemstack') === 0) {
            if(empty($_POST[$var])) continue;

            $segments = explode('-', $var);

            $id = $segments[1];

            if(!isset($itemstacks[$id])) {
                $itemstacks[$id] = new ItemStack($id, -1, -1);
            }

            switch($segments[2]) {
                case 'item':
                    $itemstacks[$id]->item = $_POST[$var];
                    break;
                case 'quantity':
                    $itemstacks[$id]->quantity = $_POST[$var];
                    break;
            }
        }
    }

    if(sizeof($itemstacks) > 0) {
        $json = OrderData::_GET([$_GET['id']]);
        $order = current($json->orders);
        $cart = $json->carts[$order->cart];
        
        $cart->itemstacks = $itemstacks;

        CartData::update($cart);
    }

    if(isset($_POST['account'])) {
        if(isset($_GET['id'])) {
            OrderData::_PUT();
        } else {
            OrderData::_POST();
        }
    }

    $json = OrderData::_GET([$_GET['id']]);
    $order = current($json->orders);
    $cart = $json->carts[$order->cart];
    $itemstacks = $cart->itemstacks;
    $items = $json->items;
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
                        <h2>Order Editor</h2>

                        <form class="mb-0" method="POST">
                            <input 
                                id="id"
                                name="id"
                                type="hidden" 
                                value="<?= $_GET['id'] ?>" 
                            />
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
                                value="<?= $order->account ?>" 
                                name="account" 
                                type="id" 
                                id="account" 
                                class="form-control" 
                                required="" 
                                autofocus=""
                            >
                            <label for="items" class="pb-2 pt-2">Items</label>
                            <?php include(dirname(__FILE__) . '/../../components/items.php') ?>
                            <button class="btn btn-success mt-4 mb-0 w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>