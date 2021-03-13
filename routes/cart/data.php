<?php
    include_once(dirname(__FILE__) . "/../../db/account.php");
    include_once(dirname(__FILE__) . "/../../db/cart.php");

    if(!isset($_SESSION['accountID'])) {
        echo "{}";
        die();
    }

    $account = current(AccountData::find([$_SESSION['accountID']]));

    $json = CartData::_GET([$account->cart]);

    $cart = current($json->carts);
    $items = $json->items;

    $json = new stdClass();
    
    $json->items = [];

    $json->total = 0;

    foreach($cart->itemstacks as $itemstack) {
        $item = $items[$itemstack->item];
        $json->total += $itemstack->quantity * $item->price;
        $json->items[] = $itemstack->quantity . " x " . $item->name . " - $" . number_format(round($itemstack->quantity * $item->price, 2), 2);
    }

    $json->total = number_format(round($json->total, 2), 2);
    $json->qst = number_format(round(0.09975 * $json->total, 2), 2);
    $json->gst = number_format(round(0.05 * $json->total, 2), 2);
    $json->total += number_format(round($json->qst + $json->gst, 2), 2);

    echo json_encode($json);
?>