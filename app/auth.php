<?php
    include_once(dirname(__FILE__) . "/router.php");

    function requires_admin() {
        // redirect("401");
    }

    function attempt_login() {
        if(!isset($_POST["email"]) || !isset($_POST["password"])) {
            return;
        }

        redirect("/");
    }

    function attempt_signup() {
        if(!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["name"]) || !isset($_POST["address"])) {
            return;
        }

        redirect("/login?success=1");
    }
?>