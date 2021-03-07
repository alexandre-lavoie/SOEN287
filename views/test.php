<?php
    include_once(dirname(__FILE__) . "/../models/account.php");
    include_once(dirname(__FILE__) . "/../models/cart.php");
    include_once(dirname(__FILE__) . "/../db/account.php");

    print_r(AccountData::find());
?>