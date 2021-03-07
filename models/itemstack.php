<?php
    include_once(dirname(__FILE__) . "/../utils/xml.php");
    
    class ItemStack {
        public $id;
        public $item;
        public $quantity;

        function __construct($id, $item, $quantity) {
            $this->id = $id;
            $this->item = $item;
            $this->quantity = $quantity;
        }

        public static function fromXML($xml) {
            return new ItemStack(
                (string)$xml['id'],
                (string)$xml->item,
                (string)$xml->quantity
            );
        }

        public static function fromXMLList($xml) {
            $itemstacks = [];

            if(!isset($xml->itemstack)) return [];

            foreach($xml->itemstack as $itemstackXML) {
                $itemstacks[] = ItemStack::fromXML($itemstackXML);
            }

            return $itemstacks;
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><itemstack></itemstack></xml>");

            $xml->itemstack->addAttribute('id', $this->id);
            $xml->itemstack->addChild('item', $this->item);
            $xml->itemstack->addChild('quantity', $this->quantity);

            return $xml;
        }

        public static function asXMLList($itemstacks) {
            $xml = simplexml_load_string("<xml><itemstacks></itemstacks></xml>");

            foreach($itemstacks as $itemstack) {
                simplexml_append($xml->itemstack, $itemstack->asXML());
            }

            return $xml;
        }
    }
?>