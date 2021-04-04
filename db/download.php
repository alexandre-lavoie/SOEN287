<?php
    class Download {
        public static function xml() {
            $file = dirname(__FILE__) . '/data.xml';

            if (file_exists($file)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/xml');
                header('Content-Disposition: attachment; filename="' . basename($file) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }
        }
    }
?>