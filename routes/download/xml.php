<?php
    requires_admin();

    include_once(dirname(__FILE__) . "/../../db/download.php");

    Download::xml();
?>