<?php
    /**
     * @param cart_item
     */
?>

<div class="card px-2 mb-2">
    <div class="row">
        <div class="d-flex col py-2 justify-content-center">
            <img class="w-100" style="max-height: 200px; object-fit: cover;" src="<?= $cart_item->item->image ?>"></img>
        </div>
        <div class="col-12 py-2 col-lg-7">
            <h4><?= $cart_item->item->name ?></h4>
            <h5 class="text-success">$<?= $cart_item->item->price ?></h5>
            <div class="card-text" style="max-height: 200px; text-align: justify;"><?= $cart_item->item->description ?></div>
        </div>
        <div class="d-flex col-12 col-lg-3 py-2 justify-content-center align-items-center">
            <?php
                $quantity = $cart_item->quantity;

                include("quantity-selector.php")
            ?>
        </div>
    </div>
</div>