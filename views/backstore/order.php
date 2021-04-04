<?php
    include_once(dirname(__FILE__) . "/../../models/itemstack.php");
    include_once(dirname(__FILE__) . "/../../db/cart.php");
    include_once(dirname(__FILE__) . "/../../db/order.php");

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

    if(isset($_POST['account'])) {
        if(isset($_GET['id'])) {
            OrderData::_PUT();
        } else {
            $order = OrderData::_POST();

            $_GET['id'] = $order->id;
        }
    }

    if(sizeof($itemstacks) > 0) {
        $json = OrderData::_GET([$_GET['id']]);
        $order = current($json->orders);
        $cart = $json->carts[$order->cart];
        
        $cart->itemstacks = $itemstacks;

        CartData::update($cart);
    }

    $json = OrderData::_GET([$_GET['id']]);
    $order = current($json->orders);
    $cart = $json->carts[$order->cart];
    $itemstacks = $cart->itemstacks;
    $items = $json->items;

    $OBJECT = $order;
    $OBJECT->date = explode(" ", $order->time)[0];
    $OBJECT->time = explode(" ", $order->time)[1];
    $OBJECT->itemstacks = $itemstacks;
    $NAME = "Order";
    $FIELDS = ['date', 'time', 'account', 'itemstacks'];
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