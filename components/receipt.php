<?php
    /**
     * @param itemstacks
     * @param items
     */

    $total = 0;

    foreach($itemstacks as $itemstack) {
        $total += $itemstack->quantity * $items[$itemstack->item]->price;
    }

    $qst = 0.09975 * $total;

    $gst = 0.05 * $total;

    $total += $qst + $gst;
?>

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