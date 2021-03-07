<?php
    $_JSON = json_decode(file_get_contents('php://input'), true);
    
    if(isset($_JSON)) $_POST = array_merge($_POST, $_JSON);
?>