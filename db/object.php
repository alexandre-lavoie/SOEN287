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

                $instances[$instance->id] = $instance;
            }
            
            return $instances;
        }

        public static function insert($instance) {
            if(is_null($instance)) return NULL;

            $xml = self::get_xml();

            simplexml_append($xml, $instance->asXML());

            Data::save_instance();

            return $instance;
        }

        public static function insert_params($params) {
            $classname = static::get_classname();

            if(empty($params[0]) || is_null($params[0])) {
                $params[0] = static::next_id();
            }

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

            return static::insert_params($params);
        }

        public static function update($instance) {
            $singular = static::get_singular();
            $targetXML = static::get_instance_xml($instance->id)[0];
            $sourceXML = $instance->asXML()->{$singular};

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

        public static function route($doesPrint = TRUE) {
            $response = static::{'_' . $_SERVER['REQUEST_METHOD']}();

            if($doesPrint) echo json_encode($response);

            return $response;
        }

        public static function _GET($ids = NULL) {
            if(is_null($ids) && isset($_GET['id'])) {
                $ids = [$_GET['id']];
            }

            $plural = static::get_plural();
            $json = new stdClass();
            
            $json->{$plural} = static::find($ids);

            return $json;
        }

        public static function _POST() {
            return static::insert_route();
        }

        public static function _PUT() {
            return static::update_route();
        }

        public static function _DELETE() {
            return static::delete($_POST['id']);
        }
    }
?>