<?php
    include "lib/crypto.php";
    session_start();

    if(!isset($_SESSION["admin"]) || !$_SESSION["admin"]) {
        if(isset($_COOKIE["remember_me"])) {
            if ($remember_me = validate_remember_me_cookie($_COOKIE["remember_me"])) {
                $_SESSION["admin"] = boolval($remember_me[2]);
                $_SESSION["username"] = $remember_me[0];
            } else {
                header("Location: /admin/login.php");
                die();
            }
        } else {
            header("Location: /admin/login.php");
            die();
        }
    }    
?>
