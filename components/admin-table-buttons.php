<?php
    /**
     * @param URL
     * @param ID
     */
?>

<a class="m-2 no-dec" href="<?= $URL ?>?id=<?= $ID ?>">
    <button class="btn btn-success">Edit</button>
</a>
<form method="POST" style="display: inline">
    <input id="delete" name="delete" type="hidden" value="<?= $ID ?>"/>
    <button class="btn btn-danger">Delete</button>
</form>