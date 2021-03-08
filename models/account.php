<?php
    include_once(dirname(__FILE__) . "/../db/cart.php");

    class Account {
        public $id;
        public $name;
        private $password;
        public $email;
        public $address;
        public $cart;

        function __construct($id, $name, $password, $email, $address, $cart) {
            $this->id = $id;
            $this->name = $name;
            $this->password = $password;
            $this->email = $email;
            $this->address = $address;
            $this->cart = $cart;
        }

        public static function fromXML($xml) {
            return new Account(
                (string) $xml['id'],
                (string) $xml->name,
                (string) $xml->password,
                (string) $xml->email,
                (string) $xml->address,
                (string) $xml->cart
            );
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><account></account></xml>");

            $xml->account->addAttribute('id', $this->id);
            $xml->account->addChild('name', $this->name);
            $xml->account->addChild('password', $this->password);
            $xml->account->addChild('email', $this->email);
            $xml->account->addChild('address', $this->address);
            $xml->account->addChild('cart', $this->cart);

            return $xml;
        }

        public function password_equals($password) {
            return $this->password == $password;
        }

        public function new_cart() {
            $this->cart = CartData::insert_params([CartData::next_id(), []])->id;
        }
    }
?>