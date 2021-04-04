<?php
    include_once(dirname(__FILE__) . "/object.php");

    class ItemData extends ObjectData {
        public static function default_data() {
            return new Item(-1, "Default Product", "Add Product in Backstore!", "/public/images/pexels-fernando-arcos-211122.jpg", 0.00);
        }
    }
?>