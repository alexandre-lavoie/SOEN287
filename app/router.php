<?php
    /**
     * @param APP_NAME
     */

    include_once(dirname(__FILE__) . "/json.php");

    function get_base_url() {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://") . $_SERVER["HTTP_HOST"];
    }

    function get_error_path($error) {
        if($error == "404") {
            return dirname(__FILE__) . '/../errors/404.php';
        } else if($error == "401") {
            return dirname(__FILE__) . '/../errors/401.php';
        } else {
            return NULL;
        }
    }

    function redirect($path) {
        $error_path = get_error_path($path);

        if(!is_null($error_path)) {
            include($error_path);

            die();
        }
        
        header('Location: ' . get_base_url() . $path);

        die();
    }

    function route($uri) {
        $request_split = explode("/", substr($uri, 1));

        if ($request_split[0] == "api") {
            $path_split = array_slice($request_split, 1, -1, true);

            $path = join("/", $path_split) . "/";

            $file = explode('?', end($request_split), 2)[0];

            if ($file == "") {
                $file = "index";
            }

            if ($path == "/") {
                $path = "";
            }

            $route_files = [
                dirname(__FILE__) . "/../routes/" . $path . $file . ".php",
                dirname(__FILE__) . "/../routes/" . $path . $file . "/" . "index.php"
            ]; 

            foreach($route_files as $route_file) {
                if (!file_exists($route_file)) continue;

                header('Content-Type: application/json');

                return $route_file;
            }

            return get_error_path("404");
        } else {
            $path_split = array_slice($request_split, 0, -1, true);

            $path = join("/", $path_split) . "/";

            $uri_no_args = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

            $ext = pathinfo($uri_no_args, PATHINFO_EXTENSION);

            $name = basename($uri_no_args, "." . $ext);

            if ($name == "") {
                $name = "index";
            }

            global $PAGE_TITLE, $APP_NAME;

            $PAGE_TITLE = ucfirst($name) . " | " . $APP_NAME;
        
            if ($ext == "") {
                $ext = "php";
            }
        
            if ($ext != "php") {
                return get_error_path("404");
            }

            $view_files = [
                dirname(__FILE__) . "/../views/" . $path . $name . "." . $ext,
                dirname(__FILE__) . "/../views/" . $path . $name . "/" . "index.php"
            ];

            foreach($view_files as $view_file) {
                if (!file_exists($view_file)) continue;

                return $view_file;
            }

            return get_error_path("404");
        }
    }

    include route($_SERVER["REQUEST_URI"]);
?>