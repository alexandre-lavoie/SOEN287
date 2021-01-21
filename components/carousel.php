<?php
    /**
     * @param splash_images
     */
?>

<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for($i = 0; $i < sizeof($splash_images); $i++) { ?>
            <li data-target="#carousel" onclick="$('.carousel').carousel(<?= $i ?>)" data-slide-to="<?= $i ?>" <?= $i == 0 ? 'class="active"' : '' ?>></li>
        <?php } ?>
    </ol>
    <div class="carousel-inner">
        <?php for($i = 0; $i < sizeof($splash_images); $i++) { ?>
            <div class="carousel-item <?= $i == 0 ? 'active' : ''?>">
                <img class="d-block w-100" style="height: 550px; object-fit: cover;" src="<?= $splash_images[$i]->image ?>" alt="<?= $splash_images[$i]->name ?>">
                <div class="carousel-caption d-none d-md-block">
                    <h5><?= $splash_images[$i]->name ?></h5>
                    <p><?= $splash_images[$i]->description ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <a class="carousel-control-prev" onclick="$('.carousel').carousel('prev')" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" onclick="$('.carousel').carousel('next')" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
</div>