<?php
    requires_admin();

    include_once(dirname(__FILE__) . "/../../db/upload.php");

    Upload::xml();
?>