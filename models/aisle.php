<?php
    include_once(dirname(__FILE__) . "/itemstack.php");

    class Aisle {
        public $id;
        public $name;
        public $description;
        public $image;
        public $itemstacks;

        function __construct($id, $name, $description, $image, $itemstacks) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->image = $image;
            $this->itemstacks = $itemstacks;
        }

        public static function fromXML($xml) {
            return new Aisle(
                (string) $xml['id'],
                (string) $xml->name,
                (string) $xml->description,
                (string) $xml->image,
                ItemStack::fromXMLList($xml->itemstacks)
            );
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><aisle></aisle></xml>");

            $xml->aisle->addAttribute('id', $this->id);
            $xml->aisle->addChild('name', $this->name);
            $xml->aisle->addChild('description', $this->description);
            $xml->aisle->addChild('image', $this->image);
            simplexml_append($xml->aisle, ItemStack::asXMLList($this->itemstacks));

            return $xml;
        }
    }
?>