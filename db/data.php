<?php
    include_once(dirname(__FILE__) . "/../utils/xml.php");

    class Data {
        private static $xml;
        private static $file = "/data.xml";

        private static function get_file_location() {
            return dirname(__FILE__) . self::$file;
        }

        private static function load_instance() {
            $fileLocation = self::get_file_location();

            if(file_exists($fileLocation)) {
                // libxml_use_internal_errors(true);

                self::$xml = simplexml_load_file($fileLocation);

                // libxml_clear_errors();
                // libxml_use_internal_errors(false);

                if(self::$xml != false) return;
            }

            self::$xml = simplexml_load_string("<weo></weo>");
        }

        public static function save_instance() {
            $fileLocation = self::get_file_location();

            $dom = new DOMDocument;
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML(self::$xml->asXML());

            file_put_contents($fileLocation, $dom->saveXML());
        }

        public static function get_instance() {
            if(!isset(self::$xml)) self::load_instance();

            return self::$xml;
        }
    }
?>