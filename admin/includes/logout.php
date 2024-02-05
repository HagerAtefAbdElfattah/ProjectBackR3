<?php
// --the session ends (logout)--------
session_start();
session_unset();
header("location:../login.php");
?>