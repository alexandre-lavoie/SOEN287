<?php
    /**
     * @param aisle
     */
?>

<div class="card w-100">
    <div class="media">
        <div class="media-body">
            <a href="/aisle?id=<?= $aisle->id ?>" class="stretched-link"></a>
            <img src="<?= $aisle->image ?>" class="card-img-top" style="height: 250px; object-fit: cover;" alt="<?= $aisle->title ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $aisle->name ?></h5>
                <p class="card-text"><?= $aisle->description ?></p>
            </div>
        </div>
    </div>
</div>