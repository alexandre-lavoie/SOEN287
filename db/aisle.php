<?php
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/item.php");

    class AisleData extends ObjectData {
        public static function default_data() {
            return new Aisle(-1, "Default Aisle", "Add Aisle in Backstore!", "/public/images/pexels-fernando-arcos-211122.jpg", []);
        }

        public static function _GET($ids = NULL) {
            $json = parent::_GET($ids);

            $item_ids = array();

            foreach($json->{static::get_plural()} as $instance) {
                foreach($instance->itemstacks as $itemstack) {
                    $item_ids[$itemstack->item] = true;
                }
            }

            $json = (object) array_merge((array) $json, (array) ItemData::_GET(array_keys($item_ids)));

            return $json;
        }
    }
?>