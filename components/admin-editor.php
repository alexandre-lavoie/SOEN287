<?php
    /**
     * @param OBJECT
     * @param FIELDS
     * @param NAME
     */
?>

<div class="card p-2">
    <h2><?= $NAME ?> Editor</h2>

    <form class="mb-0" method="POST">
        <input 
            id="id"
            name="id"
            type="hidden" 
            value="<?= $_GET['id'] ?>" 
        />
        <?php foreach($FIELDS as $field) { ?>
            <?php if($field === 'itemstacks') { 
                $itemstacks = $OBJECT->itemstacks;
            ?>
                <label for="items" class="pb-2 pt-2">Items</label>
                <?php include(dirname(__FILE__) . '/items.php') ?>
            <?php } else { ?>
                <label for="<?= $field ?>" class="pb-2 pt-2"><?= ucwords($field) ?></label>
                <input 
                    value="<?= isset($OBJECT->{$field}) ? $OBJECT->{$field} : '' ?>" 
                    name="<?= $field ?>" 
                    type="<?= in_array($field, ['image']) ? 'text' : $field ?>" 
                    id="<?= $field ?>" 
                    class="form-control" 
                    required="" 
                    autofocus=""
                >
            <?php } ?>
        <?php } ?>
        <button class="btn btn-success mt-4 mb-0 w-100">Submit</button>
    </form>
</div>