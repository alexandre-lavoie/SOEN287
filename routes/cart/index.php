<?php
    include_once(dirname(__FILE__) . "/../../db/cart.php");

    print_r($_POST);

    CartData::route();
?>