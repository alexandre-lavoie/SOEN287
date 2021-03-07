<?php
    include_once(dirname(__FILE__) . "/data.php");

    function include_models() {
        foreach(scandir(dirname(__FILE__) . '/../models') as $file) {
            $path = dirname(__FILE__) . '/../models/' . $file;
    
            if(is_file($path)) {
                include_once($path);
            }
        }
    }

    include_models();

    class ObjectData {
        protected static function get_singular() {
            $camelCase = str_replace('Data', '', get_called_class());
            $snakeUppercase = preg_replace('/([a-z])([A-Z])/', "$1_$2", $camelCase);

            return strtolower($snakeUppercase);
        }

        protected static function get_plural() {
            return static::get_singular() . 's';
        }

        protected static function get_classname() {
            return ucfirst(str_replace('Data', '', get_called_class()));
        }

        private static function get_xml() {
            $instance = Data::get_instance();
            $plural = static::get_plural();

            if(!isset($instance->{$plural})) {
                $instance->addChild($plural, '');
            }

            return $instance->{$plural};
        }

        protected static function get_class_params() {
            $reflection = new ReflectionClass(static::get_classname());

            $params = [];

            foreach($reflection->getProperties() as $property) {
                $params[] = $property->name;
            }

            return $params;
        }

        private static function get_instance_xml($id) {
            $xml = self::get_xml();
            $singular = static::get_singular();
            $plural = static::get_plural();

            return $xml->xpath('//' . $plural . "/" . $singular . "[@id=\"$id\"]");
        }

        public static function find($targets = NULL) {
            $xml = self::get_xml();
            $singular = static::get_singular();
            $classname = static::get_classname();

            $instances = [];

            if(!isset($xml->{$singular})) return [];

            foreach($xml->{$singular} as $instanceXML) {
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

            return $instance;
        }

        public static function insert_params($params) {
            $classname = static::get_classname();

            return static::insert(
                new $classname(
                    ...$params
                )
            );
        }

        protected static function insert_route() {
            $params = [];
    
            foreach(static::get_class_params() as $param) {
                $params[] = $_POST[$param];
            }

            $params[0] = static::next_id();

            return static::insert_params($params);
        }

        public static function update($instance) {
            $targetXML = static::get_instance_xml($instance->id)[0];
            $sourceXML = $instance->asXML()->account;

            $targetDOM = dom_import_simplexml($targetXML);
            $sourceDOM = dom_import_simplexml($sourceXML);

            $nodeImport = $targetDOM->ownerDocument->importNode($sourceDOM, TRUE);
            $targetDOM->parentNode->replaceChild($nodeImport, $targetDOM);

            Data::save_instance();

            return $instance;
        }

        public static function update_route() {
            $instance = static::find([$_POST['id']])[0];

            if(is_null($instance)) return null;

            foreach(static::get_class_params() as $param) {
                if(!isset($_POST[$param]) || empty($_POST[$param])) continue;

                $instance->{$param} = $_POST[$param]; 
            }

            print_r($instance);

            return static::update($instance);
        }

        public static function delete($id) {
            $instanceXML = static::get_instance_xml($id);

            if(sizeof($instanceXML) == 0) return false;

            unset($instanceXML[0][0]);

            Data::save_instance();

            return true;
        }

        public static function next_id() {
            $instances = static::find();

            return end($instances)->id + 1;
        }

        public static function route() {
            static::{'_' . $_SERVER['REQUEST_METHOD']}();
        }

        protected static function _GET() {
            $plural = static::get_plural();

            echo "{\"$plural\": " . json_encode(static::find()) . '}';
        }

        protected static function _POST() {
            echo json_encode(static::insert_route());
        }

        protected static function _PUT() {
            echo json_encode(static::update_route());
        }

        protected static function _DELETE() {
            echo static::delete($_POST['id']);
        }
    }
?>