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

        $itemstacks[] = $itemstack;

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

    /**
     * Calculate total.
     */
    $total = 0;

    foreach($itemstacks as $itemstack) {
        $total += $itemstack->quantity * $items[$itemstack->item]->price;
    }

    $qst = 0.09975 * $total;

    $gst = 0.05 * $total;

    $total += $qst + $gst;
?>

<html lang="en">
    <head>
        <?php include("../components/head.php") ?>
        <script>
            const cart = <?= json_encode($cart) ?>;

            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll("input[id*='quantity']").forEach(element => {
                    element.onchange = updateItemStack;
                });
            }, false);

            async function updateItemStack(event) {
                let itemID = event.target.id.replace("quantity-", '');
                cart.itemstacks[itemID].quantity = event.target.value;

                updateCart();
            }

            async function updateCart() {
                await fetch("/api/cart", { method: "PUT", body: JSON.stringify(cart) });

                refreshReceipt();
            }

            async function refreshReceipt() {
                let json = await (await fetch("/api/cart/data")).json();

                console.log(json.items);

                document.querySelector("#items").innerHTML = json.items.map(item => `<i>${item}</i>`).join('</br>');
                document.querySelector("#qst").innerHTML = Number(json.qst).toFixed(2);
                document.querySelector("#gst").innerHTML = Number(json.gst).toFixed(2);
                document.querySelector("#total").innerHTML = Number(json.total).toFixed(2);
            }
        </script>
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
                    <form method="POST" class="card p-2">
                        <h4 class="mb-0 mt-2">Receipt</h4>
                        <hr />
                        <span id="items">
                            <?php foreach(array_values($itemstacks) as $itemstack) { ?>
                                <i><?= $itemstack->quantity ?> x <?= $items[$itemstack->item]->name ?> - $<?= number_format($itemstack->quantity * $items[$itemstack->item]->price, 2) ?></i><br/>
                            <?php } ?>
                        </span>
                        <hr />
                        <span>QST: $<span id="qst"><?= number_format($qst, 2) ?></span></span>
                        <span>GST: $<span id="gst"><?= number_format($gst, 2) ?></span></span>
                        <hr />
                        <h5 class="pb-2">Total: $<span id="total"><?= number_format($total, 2) ?></span></h5>
                        <input type="hidden" name="checkout" value="1"/>
                        <button class="btn w-100 btn-success">Checkout</button>
                    </form>
                </div>
            </div>
        </section>
        <?php include("../components/footer.php") ?>
    </body>
</html>