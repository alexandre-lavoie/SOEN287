<?php
    include_once(dirname(__FILE__) . "/data.php");
    include_once(dirname(__FILE__) . "/object.php");
    include_once(dirname(__FILE__) . "/../models/account.php");

    class AccountData extends ObjectData {
        protected static $singular = "account";
        protected static $plural = "accounts";
    }
?>