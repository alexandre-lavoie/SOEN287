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

        static function get_samples() {
            return [
                new SplashImage(1, "Welcome to WeEatOnline", "The best online-grocery website!", "/public/images/pexels-pixabay-264636.jpg"),
                new SplashImage(2, "Tired of In-Person Pickup?", "Try us and you'll never go back!", "/public/images/pexels-anna-shvets-3962285.jpg")
            ];
        }
    }
?>