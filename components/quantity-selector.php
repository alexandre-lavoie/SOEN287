<?php
    /**
     * @param quantity
     */

    $number_id = "quantity-" . uniqid();
?>

<div class="btn-group" style="width: max-content; height: max-content;">
    <button onclick="decrement('<?= $number_id ?>')" class="btn btn-dark">-</button>
    <span id="<?= $number_id ?>" class="px-3 py-2"><?= $quantity ?></span>
    <button onclick="increment('<?= $number_id ?>')" class="btn btn-dark">+</button>
</div>