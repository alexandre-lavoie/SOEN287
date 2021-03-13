<?php
    /**
     * @param itemstacks
     */

    $largestID = ItemStack::largestID($itemstacks);
?>

<div class="table-responsive">
    <table class="table table-bordered m-0">
        <thead>
            <tr>
                <th scope="col">Item ID</th>
                <th scope="col">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($itemstacks)) { ?>
                <?php foreach($itemstacks as $itemstack) { ?>
                    <tr>
                        <td>
                            <input
                                name="itemstack-<?= $itemstack->id ?>-item"
                                id="itemstack-<?= $itemstack->id ?>-item"
                                class="form-control"
                                required="" 
                                autofocus=""
                                value="<?= $itemstack->item ?>"
                            />
                        </td>
                        <td>
                            <input
                                name="itemstack-<?= $itemstack->id ?>-quantity"
                                id="itemstack-<?= $itemstack->id ?>-quantity"
                                class="form-control"
                                required="" 
                                autofocus=""
                                value="<?= $itemstack->quantity ?>"
                            />
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            <tr>
                <td>
                    <input
                        name="itemstack-<?= $largestID + 1 ?>-item"
                        id="itemstack-<?= $largestID + 1 ?>-item"
                        class="form-control"
                        value=""
                    />    
                </td>
                <td>
                    <input
                        name="itemstack-<?= $largestID + 1 ?>-quantity"
                        id="itemstack-<?= $largestID + 1 ?>-quantity"
                        class="form-control"
                        value=""
                    />
                </td>
            </tr>
        </tbody>
    </table>
</div>