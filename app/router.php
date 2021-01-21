<?php
    /**
     * @param APP_NAME
     */
?>

<?php
    function redirect($path) {
        if($path == "404") {
            include(dirname(__FILE__) . '/../errors/404.php');

            die();
        }

        if($path == "401") {
            include(dirname(__FILE__) . '/../errors/401.php');

            die();
        }


        echo "<script>window.location.href = '$path'</script>";

        die();
    }
?>

<?php
    $request_split = explode("/", substr($_SERVER["REQUEST_URI"], 1));

    if ($request_split[0] == "api") {
        $path_split = array_slice($request_split, 1, -1, true);

        $path = join("/", $path_split) . "/";

        $file = explode('?', end($request_split), 2)[0];

        if ($file == "") {
            $file = "index";
        }

        $route_file = dirname(__FILE__) . "/../routes" . $path . $file . ".php"; 

        if (file_exists($route_file)) {
            include ($route_file);
        } else {
            $route_file = dirname(__FILE__) . "/../routes" . $path . $file . "/" . "index.php"; 

            if (file_exists($route_file)) {
                include ($route_file);
            } else {
                redirect_404();
            }
        }
    } else {
        $path_split = array_slice($request_split, 0, -1, true);

        $path = join("/", $path_split) . "/";

        $uri_no_args = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

        $ext = pathinfo($uri_no_args, PATHINFO_EXTENSION);

        $name = basename($uri_no_args, "." . $ext);

        if ($name == "") {
            $name = "index";
        }

        $PAGE_TITLE = ucfirst($name) . " | " . $APP_NAME;
    
        if ($ext == "") {
            $ext = "php";
        }
    
        if ($ext != "php") {
            redirect_404();
        }
    
        $view_file = dirname(__FILE__) . "/../views" . $path . $name . "." . $ext;

        if (file_exists($view_file)) {
            include ($view_file);
        } else {
            redirect_404();
        }
    }
?>