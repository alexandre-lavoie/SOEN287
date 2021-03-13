<?php
    class Order {
        public $id;
        public $time;
        public $account;
        public $cart;

        function __construct($id, $time, $account, $cart) {
            $this->id = $id;
            $this->time = $time;
            $this->account = $account;
            $this->cart = $cart;
        }

        public static function fromXML($xml) {
            return new Order(
                (string)$xml['id'],
                (string)$xml->time,
                (string)$xml->account,
                (string)$xml->cart
            );
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><order></order></xml>");

            $xml->order->addAttribute('id', $this->id);
            $xml->order->addChild('time', $this->time);
            $xml->order->addChild('account', $this->account);
            $xml->order->addChild('cart', $this->cart);

            return $xml;
        }
    }
?>