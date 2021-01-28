<?php
    include_once(dirname(__FILE__) . "/account.php");
    include_once(dirname(__FILE__) . "/cart-item.php");

    class Order {
        public $id;
        public $time;
        public $account;
        public $cart_items;

        function __construct($id, $time, $account, $cart_items) {
            $this->id = $id;
            $this->time = $time;
            $this->account = $account;
            $this->cart_items = $cart_items;
        }
        
        static function get_samples() {
            $accounts = Account::get_samples();
            $cart_items = CartItem::get_samples();

            return [
                new Order(1, date("Y-m-d H:i:s"), $accounts[0], $cart_items)
            ];
        }
    }
?>