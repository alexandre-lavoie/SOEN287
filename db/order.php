<?php
    include_once(dirname(__FILE__) . "/data.php");
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/../models/order.php");

    class OrderData extends ObjectData {
        protected static $singular = "order";
        protected static $plural = "orders";
    }
?>