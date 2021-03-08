<?php
    /**
     * @param itemstack
     * @param items
     */

    $item = $items[$itemstack->item];
?>

<div class="card px-2 mb-2">
    <div class="row">
        <div class="d-flex col py-2 justify-content-center">
            <img class="w-100" style="max-height: 200px; object-fit: cover;" src="<?= $item->image ?>"></img>
        </div>
        <div class="col-12 py-2 col-lg-7">
            <h4><?= $item->name ?></h4>
            <h5 class="text-success">$<?= $item->price ?></h5>
            <div class="card-text" style="max-height: 200px; text-align: justify;"><?= $item->description ?></div>
        </div>
        <div class="d-flex col-12 col-lg-3 py-2 justify-content-center align-items-center">
            <?php
                $selector_id = "quantity-" . $itemstack->id;
                $quantity = $itemstack->quantity;

                include("quantity-selector.php")
            ?>
        </div>
    </div>
</div>