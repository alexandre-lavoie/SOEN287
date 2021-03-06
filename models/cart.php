<?php
    class Cart {
        public $id;
        public $items;

        function __construct($id, $items) {
            $this->id = $id;
            $this->items = $items;
        }

        /**
         * TODO: Return non-null cart.
         */
        public function asXML() {
            $xml = simplexml_load_string("<xml><cart></cart></xml>");

            return $xml;
        }

        /**
         * TODO: Return non-null cart.
         */
        public static function fromXML($xml) {
            return new Cart(0, []);
        }
    }
?>