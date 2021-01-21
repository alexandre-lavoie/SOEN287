<?php
    /**
     * @param item
     */
?>

<div class="card w-100">
    <div class="media">
        <div class="media-body">
            <a href="/item?id=<?= $item->id ?>" class="stretched-link"></a>
            <img src="<?= $item->image ?>" class="card-img-top" style="height: 250px; object-fit: cover;" alt="<?= $item->title ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $item->name ?></h5>
                <p class="card-text"><?= $item->description ?></p>
            </div>
        </div>
    </div>
</div>