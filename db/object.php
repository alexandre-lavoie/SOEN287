<?php
    include_once(dirname(__FILE__) . "/data.php");

    class ObjectData {
        protected static $singular;
        protected static $plural;

        private static function get_xml() {
            $instance = Data::get_instance();

            if(!isset($instance->{static::$plural})) {
                $instance->addChild(static::$plural, '');
            }

            return $instance->{static::$plural};
        }

        public static function find($targets = NULL) {
            $xml = self::get_xml();
            $instances = [];

            if(!isset($xml->{static::$singular})) return [];

            $classname = ucfirst(static::$singular);

            foreach($xml->{static::$singular} as $instanceXML) {
                $instance = $classname::fromXML($instanceXML);

                if(!is_null($targets) && !in_array($instance->id, $targets)) continue;  

                $instances[] = $instance;
            }
            
            return $instances;
        }

        public static function insert($instance) {
            $xml = self::get_xml();

            simplexml_append($xml, $instance->asXML());

            Data::save_instance();
        }
    }
?>