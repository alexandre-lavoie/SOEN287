<?php
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/cart.php");

    class AccountData extends ObjectData {
        public static function _GET($ids = NULL) {
            $json = parent::_GET($ids);

            $cart_ids = array();

            foreach($json->{static::get_plural()} as $instance) {
                $cart_ids[$instance->cart] = true;
            }

            $json = (object) array_merge_recursive((array) $json, (array) CartData::_GET(array_keys($cart_ids)));

            return $json;
        }

        public static function login($email, $password) {
            foreach(static::find() as $account) {
                if($account->email == $email && $account->password_equals($password)) {
                    $_SESSION['accountID'] = $account->id;

                    return $account;
                }
            }

            return NULL;
        }

        public static function insert($instance) {
            if(empty($instance->cart)) $instance->new_cart();

            return parent::insert($instance);
        }
    }
?>