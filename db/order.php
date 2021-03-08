<?php
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/account.php");
    include_once(dirname(__FILE__) . "/cart.php");

    class OrderData extends ObjectData {
        public static function _GET($ids = NULL) {
            $json = parent::_GET($ids);

            $account_ids = array();
            $cart_ids = array();

            foreach($json->{static::get_plural()} as $instance) {
                $account_ids[$instance->account] = true;
                $cart_ids[$instance->cart] = true;
            }

            $json = (object) array_merge((array) $json, (array) AccountData::_GET(array_keys($account_ids)));
            $json = (object) array_merge((array) $json, (array) CartData::_GET(array_keys($cart_ids)));

            return $json;
        }

        public static function insert($instance) {
            if(empty($instance->time) || is_null($instance->time)) {
                $instance->time = date("Y-m-d H:i:s");
            }

            if(empty($instance->cart) || is_null($instance->cart)) {
                $account = current(AccountData::find([$instance->account]));

                if(!is_null($account)) {
                    $instance->cart = $account->cart;

                    $account->new_cart();
    
                    AccountData::update($account);
                }
            }

            return parent::insert($instance);
        }
    }
?>