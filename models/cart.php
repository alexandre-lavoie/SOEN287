<?php
    include_once(dirname(__FILE__) . "/itemstack.php");

    class Cart {
        public $id;
        public $itemstacks;

        function __construct($id, $itemstacks) {
            $this->id = $id;
            $this->itemstacks = $itemstacks;
        }

        public static function fromXML($xml) {
            return new Cart(
                (string) $xml['id'],
                ItemStack::fromXMLList($xml->itemstacks)
            );
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><cart></cart></xml>");

            $xml->cart->addAttribute('id', $this->id);
            simplexml_append($xml->cart, ItemStack::asXMLList($this->itemstacks));

            return $xml;
        }
    }
?>