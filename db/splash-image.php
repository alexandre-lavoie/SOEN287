<?php
    include_once(dirname(__FILE__) . "/data.php");
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/../models/splash-image.php");

    class SplashImageData extends ObjectData {
        protected static $singular = "splash-image";
        protected static $plural = "splash-images";
    }
?>