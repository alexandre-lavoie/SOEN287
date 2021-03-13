<?php
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/item.php");

    class CartData extends ObjectData {
        public static function _GET($ids = NULL) {
            $json = parent::_GET($ids);

            $item_ids = array();

            foreach($json->{static::get_plural()} as $instance) {
                foreach($instance->itemstacks as $itemstack) {
                    $item_ids[$itemstack->item] = true;
                }
            }

            $json = (object) array_merge_recursive((array) $json, (array) ItemData::_GET(array_keys($item_ids)));

            return $json;
        }
    }
?>