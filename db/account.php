<?php
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/cart.php");

    class AccountData extends ObjectData {
        public static function insert($instance) {
            $instance->cart = CartData::insert_params([CartData::next_id(), []])->id;

            return parent::insert($instance);
        }
    }
?>