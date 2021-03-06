<?php
    include_once(dirname(__FILE__) . "/cart.php");

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
                (string) $xml->id,
                (string) $xml->name,
                (string) $xml->password,
                (string) $xml->email,
                (string) $xml->address,
                Cart::fromXML($xml->cart)
            );
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><account></account></xml>");

            $xml->account->addChild('id', $this->id);
            $xml->account->addChild('name', $this->name);
            $xml->account->addChild('password', $this->password);
            $xml->account->addChild('email', $this->email);
            $xml->account->addChild('address', $this->address);
            simplexml_append($xml->account, $this->cart->asXML());

            return $xml;
        }

        static function get_samples() {
            return [
                new Account(1, "John Doe", "password", "john.doe@gmail.com", "1234 Street, City, Country H6Y A2Z", new Cart(0, []))
            ];
        }
    }
?>