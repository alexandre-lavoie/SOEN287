<?php
    class Item {
        public $id;
        public $name;
        public $description;
        public $image;
        public $price;

        function __construct($id, $name, $description, $image, $price) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->description = $description;
            $this->image = $image;
        }

        public static function fromXML($xml) {
            return new Item(
                (string)$xml['id'],
                (string)$xml->name,
                (string)$xml->description,
                (string)$xml->image,
                (string)$xml->price
            );
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><item></item></xml>");

            $xml->item->addAttribute('id', $this->id);
            $xml->item->addChild('name', $this->name);
            $xml->item->addChild('price', $this->price);
            $xml->item->addChild('description', $this->description);
            $xml->item->addChild('image', $this->image);

            return $xml;
        }
    }
?>