<?php
    /**
     * @param selector_id
     * @param quantity
     */
?>

<div class="btn-group" style="width: max-content; height: max-content;">
    <button type="button" onclick="decrement('<?= $selector_id ?>')" class="btn btn-dark nojs">-</button>
    <input id="<?= $selector_id ?>" name="<?= $selector_id ?>" class="px-3 py-2" style="max-width: 100px" value="<?= $quantity ?>" />
    <button type="button" onclick="increment('<?= $selector_id ?>')" class="btn btn-dark nojs">+</button>
</div>