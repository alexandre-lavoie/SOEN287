<?php
    include_once(dirname(__FILE__) . "/item.php");

    class ItemStack {
        public $id;
        public $item;
        public $quantity;

        function __construct($id, $item, $quantity) {
            $this->id = $id;
            $this->item = $item;
            $this->quantity = $quantity;
        }
    }
?>