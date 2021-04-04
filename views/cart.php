<?php 
    requires_account();

    include_once("../db/account.php");
    include_once("../db/cart.php");
    include_once("../db/item.php");
    include_once("../db/order.php");
    include_once("../models/order.php");
    include_once("../models/itemstack.php");

    $json = AccountData::_GET([$_SESSION["accountID"]]);
    $account = current($json->accounts);
    $cart = current($json->carts);
    $itemstacks = $cart->itemstacks;
    $items = $json->items;

    /**
     * Checkout cart.
     */
    if(isset($_POST['checkout'])) {
        OrderData::insert_params([NULL, NULL, $account->id, NULL]);

        redirect('/');
    }

    /**
     * Add item to cart.
     */
    if(isset($_POST['item']) && isset($_POST['quantity'])) {
        $id = end($itemstacks)->id + 1;

        $itemstack = new ItemStack($id, $_POST['item'], $_POST['quantity']);

        $itemstacks[$id] = $itemstack;

        $cart->itemstacks = $itemstacks;

        $new_item = current(ItemData::find([$_POST['item']]));

        $items[$new_item->id] = $new_item;

        CartData::update($cart);
    }

    /**
     * Redirect if empty cart.
     */
    if(sizeof($items) == 0) {
        redirect("/");
    }
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
        <script> const cart = <?= json_encode($cart) ?>; </script>
        <script src="/public/js/cart.js"></script>
    </head>
    <body class="bg-light">
        <?php include("../components/header.php") ?>

        <div class="p-3 bg-dark text-white">
            <span>My Cart</span>
        </div>

        <section class="p-2" style="min-height: 76vh">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <?php 
                        foreach($itemstacks as $itemstack) {
                            include("../components/cart-item.php");
                        }
                    ?>
                </div>
                <div class="col-12 col-lg-4">
                    <?php include("../components/receipt.php") ?>
                </div>
            </div>
        </section>
        <?php include("../components/footer.php") ?>
    </body>
</html>