<?php
    include_once(dirname(__FILE__) . "/data.php");
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/../models/aisle.php");

    class AisleData extends ObjectData {
        protected static $singular = "aisle";
        protected static $plural = "aisles";
    }
?>