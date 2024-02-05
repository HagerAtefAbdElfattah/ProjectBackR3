<?php
   session_start();
   // ---creating a variable to echo in the name of the admin ------
   if (isset($_SESSION["user"])) {
    $adminName = $_SESSION["user"]["name"];
    $adminImage = $_SESSION["user"]["image"];
   }
   // ---if there isn't a session the admin must login first--------
   if (!isset($_SESSION ["user"]) or !$_SESSION["user"]) {
    header("location: login.php");
    die();
   }
?>