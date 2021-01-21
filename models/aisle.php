<?php
    include_once(dirname(__FILE__) . "/item.php");

    class Aisle {
        public $id;
        public $name;
        public $description;
        public $image;
        public $items;

        function __construct($id, $name, $description, $image, $items) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->image = $image;
            $this->items = $items;
        }

        static function get_samples() {
            return [
                new Aisle(1, "Fruits and Vegetables", "An assortment of fresh and healthy foods.", "/public/images/pexels-ponyo-sakana-4194610.jpg", Item::get_samples()),
                new Aisle(2, "Barbecue", "Everything you can need for the great outdoor.", "/public/images/pexels-skitterphoto-1105325.jpg", Item::get_samples()),
                new Aisle(3, "Sugary Foods", "A selection of the best sweets around.", "/public/images/pexels-elli-1854652.jpg", Item::get_samples())
            ];
        }
    }
?>