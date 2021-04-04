<?php
    $APP_NAME = "WEO";
    $FOOTER = "WEO is a SOEN287 project created by Alexandre Lavoie.";

    include_once(dirname(__FILE__) . "/session.php");
    include_once(dirname(__FILE__) . "/auth.php");
    include_once(dirname(__FILE__) . "/json.php");
    include_once(dirname(__FILE__) . "/router.php");

    include(route($_SERVER["REQUEST_URI"]));
?>