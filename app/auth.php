<?php
    include_once(dirname(__FILE__) . "/router.php");

    function is_account() {
        return isset($_SESSION['accountID']);
    }

    function requires_account() {
        if(is_admin()) return;

        redirect("/");
    }

    function is_admin() {
        return isset($_SESSION['accountID']);
    }

    function requires_admin() {
        if(is_admin()) return;

        redirect("401");
    }

    function attempt_login() {
        if(!isset($_POST["email"]) || !isset($_POST["password"])) {
            return;
        }

        include_once(dirname(__FILE__) . "/../db/account.php");

        if(is_null(AccountData::login($_POST["email"], $_POST["password"]))) return;

        redirect("/");
    }

    function attempt_signup() {
        if(!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["name"]) || !isset($_POST["address"])) {
            return;
        }

        include_once(dirname(__FILE__) . "/../db/account.php");

        AccountData::_POST();

        redirect("/login?success=1");
    }
?>