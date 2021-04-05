<?php
    /**
     * @param OBJECT
     * @param FIELDS
     * @param NAME
     */
    include_once(dirname(__FILE__) . "/../db/account.php");

    $accounts = AccountData::find();
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
                <label for="items" class="pb-2 pt-2">Products</label>
                <?php include(dirname(__FILE__) . '/items.php') ?>
            <?php } else if($field === 'account') { ?>
                <label for="<?= $field ?>" class="pb-2 pt-2"><?= ucwords($field) ?></label>
                <select
                    id="<?= $field ?>"
                    name="<?= $field ?>" 
                    value="<?= isset($OBJECT->{$field}) ? $OBJECT->{$field} : '' ?>" 
                    class="form-select"
                >
                    <option>Select Account</option>
                    <?php foreach($accounts as $account) { ?>
                        <option value="<?= $account->id ?>" <?= $OBJECT->{$field} === $account->id ? "selected" : "" ?>><?= $account->id ?> - <?= $account->name ?></option>
                    <?php } ?>
                </select>
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