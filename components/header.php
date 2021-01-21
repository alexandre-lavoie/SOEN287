<?php
    /**
     * @param CART_COUNT
     */

    $CART_COUNT = random_int(0, 10);
?>

<nav class="navbar px-3 navbar-expand-lg justify-content-between navbar-dark bg-success">
    <a class="navbar-brand" href="/">WEO</a>
    <div class="d-flex">
        <a href="/cart">
            <button type="button" class="btn btn-success mx-2">
                <i class="bi bi-cart2"></i>
                <span class="px-1"></span>
                <?php if($CART_COUNT > 0) { ?>
                    <span class="badge badge-pill badge-light bg-danger"><?= $CART_COUNT ?></span>
                <?php } ?>
            </button>
        </a>
        <a href="/login">
            <button type="button" class="btn btn-success">Login</button>
        </a>
    </div>
</nav>