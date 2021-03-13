<?php
    /**
     * @param selector_id
     * @param quantity
     */
?>

<div class="btn-group" style="width: max-content; height: max-content;">
    <button id="d-<?= $selector_id ?>" type="button" onclick="decrement(event)" class="btn btn-dark nojs">-</button>
    <input id="<?= $selector_id ?>" name="<?= $selector_id ?>" class="px-3 py-2" style="max-width: 100px" value="<?= $quantity ?>" />
    <button id="i-<?= $selector_id ?>" type="button" onclick="increment(event)" class="btn btn-dark nojs">+</button>
</div>