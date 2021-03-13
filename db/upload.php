<?php
    class Upload {
        public static function xml() {
            move_uploaded_file($_FILES['xml']['tmp_name'], dirname(__FILE__) . '/data.xml');
        }
    }
?>