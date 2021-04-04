<?php
    /**
     * @param aisle
     */
?>

<div class="card w-100">
    <div class="media">
        <div class="media-body">
            <?php if($aisle->id >= 0) { ?>
                <a href="/aisle?id=<?= $aisle->id ?>" class="stretched-link"></a>
            <?php } else { ?>
                <a href="/backstore/aisle" class="stretched-link"></a>
            <?php } ?> 
            <img src="<?= $aisle->image ?>" class="card-img-top" style="height: 250px; object-fit: cover;" alt="<?= $aisle->title ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $aisle->name ?></h5>
                <p class="card-text"><?= $aisle->description ?></p>
            </div>
        </div>
    </div>
</div>