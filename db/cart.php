<?php
    include_once(dirname(__FILE__) . "/data.php");
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/../models/cart.php");

    class CartData extends ObjectData {
        protected static $singular = "cart";
        protected static $plural = "carts";
    }
?>