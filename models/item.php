<?php
    class Item {
        public $id;
        public $name;
        public $description;
        public $image;
        public $price;

        function __construct($id, $name, $price, $description, $image) {
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->image = $image;
            $this->price = $price;
        }
        
        static function get_samples() {
            return [
                new Item(1, "Boneless Trimmed Chicken Breasts", 8.55, "1 kg - 5 Breasts per tray", "https://product-images.metro.ca/images/ha1/h5f/9233873764382.jpg"),
                new Item(2, "Whole Grain Spaghettini", 2.99, "375 g", "https://product-images.metro.ca/images/he1/hb3/9522440634398.jpg"),
                new Item(3, "Bag of Oranges", 2.31, "3 lb", "https://product-images.metro.ca/images/h30/hcf/8873671655454.jpg"),
                new Item(4, "Baby-Cut Carrots", 1.99, "340 g", "https://product-images.metro.ca/images/h6c/h1a/8871631028254.jpg"),
                new Item(5, "White Mushrooms", 2.49, "227 g", "https://product-images.metro.ca/images/hd9/h6b/8867485515806.jpg"),
                new Item(6, "Raspberries", 5.99, "170 g", "https://product-images.metro.ca/images/h8c/h05/9335888740382.jpg")
            ];
        }
    }
?>