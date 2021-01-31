<?php
    include_once(dirname(__FILE__) . "/item.php");

    class BackstoreItem {
        public $id;
        public $item;
        public $quantity;

        function __construct($id, $item, $quantity) {
            $this->id = $id;
            $this->item = $item;
            $this->quantity = $quantity;
        }

        static function get_samples() {
            $items = Item::get_samples();

            $backstore_items = [];

            for($i = 0; $i < sizeof($items); $i++) {
                array_push($backstore_items, new BackstoreItem($i + 1, $items[$i], random_int(1, 10)));
            }

            return $backstore_items;
        }
    }
?>