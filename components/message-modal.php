<?php
    /**
     * @param ID
     * @param TITLE
     * @param TEXT
     */
?>

<div id="<?= $ID ?>" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= $TITLE ?></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?= $TEXT ?></p>
            </div>
        </div>
    </div>
</div>