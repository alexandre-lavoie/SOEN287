<?php
    include_once(dirname(__FILE__) . "/item.php");

    class CartItem {
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

            shuffle($items);

            $items = array_slice($items, 0, random_int(1, sizeof($items)));

            $cart_items = [];

            for($i = 0; $i < sizeof($items); $i++) {
                array_push($cart_items, new CartItem($i + 1, $items[$i], random_int(1, 10)));
            }

            return $cart_items;
        }
    }
?>