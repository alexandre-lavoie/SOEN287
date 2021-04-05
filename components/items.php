<?php
    /**
     * @param itemstacks
     */
    include_once(dirname(__FILE__) . "/../db/item.php");

    $items = ItemData::find();
    $largestID = ItemStack::largestID($itemstacks);
    
    // Add empty.
    $emptyStack = new stdClass();

    $emptyStack->id = $largestID + 1;
    $emptyStack->quantity = '';

    $itemstacks[] = $emptyStack;
?>

<div class="table-responsive">
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($itemstacks)) { ?>
                <?php foreach($itemstacks as $itemstack) { ?>
                    <tr>
                        <td>
                            <select
                                name="itemstack-<?= $itemstack->id ?>-item"
                                id="itemstack-<?= $itemstack->id ?>-item"
                                value="<?= $itemstack->item ?>"
                                class="form-select"
                            >
                                <option value="">Select Product</option>
                                <?php foreach($items as $item) { ?>
                                    <option value="<?= $item->id ?>" <?= $item->id === $itemstack->item ? "selected" : "" ?>><?= $item->id ?> - <?= $item->name ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <td>
                            <input
                                name="itemstack-<?= $itemstack->id ?>-quantity"
                                id="itemstack-<?= $itemstack->id ?>-quantity"
                                type="number"
                                min="0"
                                class="form-control"
                                value="<?= $itemstack->quantity ?>"
                            />
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
</div>