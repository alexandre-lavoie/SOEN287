<?php
    include_once(dirname(__FILE__) . "/data.php");
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/../models/item.php");

    class ItemData extends ObjectData {
        protected static $singular = "item";
        protected static $plural = "items";
    }
?>