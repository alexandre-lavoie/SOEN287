<?php
    class SplashImage {
        public $id;
        public $name;
        public $description;
        public $image;

        function __construct($id, $name, $description, $image) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->image = $image;
        }

        public static function fromXML($xml) {
            return new SplashImage(
                (string)$xml['id'],
                (string)$xml->name,
                (string)$xml->description,
                (string)$xml->image
            );
        }

        public function asXML() {
            $xml = simplexml_load_string("<xml><splash></splash></xml>");

            $xml->splash->addAttribute('id', $this->id);
            $xml->splash->addChild('name', $this->name);
            $xml->splash->addChild('description', $this->description);
            $xml->splash->addChild('image', $this->image);

            return $xml;
        }
    }
?>