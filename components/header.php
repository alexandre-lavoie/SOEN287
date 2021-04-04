<?php
    /**
     * @param APP_NAME
     */
    include_once(dirname(__FILE__) . "/../db/account.php");

    $json = AccountData::_GET([$_SESSION["accountID"]]);
    $account = current($json->accounts);
    $cart = $json->carts[$account->cart];
    
    if(isset($cart)) {
        $CART_COUNT = sizeof($cart->itemstacks);
    }
?>

<nav class="navbar px-3 navbar-expand-lg justify-content-between navbar-dark bg-success">
    <a class="navbar-brand" href="/"><?= $APP_NAME ?></a>
    <div class="d-flex">
        <?php if(is_account()) { ?>
            <a href="/cart">
                <button type="button" class="btn btn-success mx-2">
                    <i class="bi bi-cart2"></i>
                    <span class="px-1"></span>
                    <?php if($CART_COUNT > 0) { ?>
                        <span id="cart-count" class="badge badge-pill badge-light bg-danger"><?= $CART_COUNT ?></span>
                    <?php } ?>
                </button>
            </a>
        <?php } ?>
            <a href="/<?= is_account() ? "logout" : "login" ?>">
            <button type="button" class="btn btn-success"><?= is_account() ? "Logout" : "Login" ?></button>
        </a>
    </div>
</nav>