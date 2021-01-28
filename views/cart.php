<?php
    include_once("../models/cart-item.php");

    $cart_items = CartItem::get_samples();

    $total = 0;

    foreach($cart_items as $cart_item) {
        $total += $cart_item->quantity * $cart_item->item->price;
    }

    $qst = 0.09975 * $total;

    $gst = 0.05 * $total;

    $total += $qst + $gst;
?>

<?php
    if(sizeof($cart_items) == 0) {
        redirect("/");
    }
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
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
                        foreach($cart_items as $cart_item) {
                            include("../components/cart-item.php");
                        }
                    ?>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card p-2">
                        <h4 class="mb-0 mt-2">Receipt</h4>
                        <hr />
                        <?php foreach($cart_items as $cart_item) { ?>
                            <i><?= $cart_item->quantity ?> x <?= $cart_item->item->name ?> - $<?= number_format($cart_item->quantity * $cart_item->item->price, 2) ?></i>
                        <?php } ?>
                        <hr />
                        <span>QST: $<?= number_format($qst, 2) ?></span>
                        <span>GST: $<?= number_format($gst, 2) ?></span>
                        <hr />
                        <h5 class="pb-2">Total: $<?= number_format($total, 2) ?></h5>
                        <button class="btn btn-success">Checkout</button>
                    </div>
                </div>
            </div>
        </section>
        <?php include("../components/footer.php") ?>
    </body>
</html>