<?php
    include_once(dirname(__FILE__) . "/object.php");

    class SplashData extends ObjectData {
        public static function default_data() {
            return new Splash(-1, "Default Splash", "Add Splash Images in Backstore!", "/public/images/pexels-fernando-arcos-211122.jpg");
        }
    }
?>