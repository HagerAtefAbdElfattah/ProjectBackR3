<?php
    $servername = "localhost";
    $username = "root";
    $password = "";

    try{
        $conn = new PDO("mysql:host=$servername;port=3306; dbname=newsproject", $username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 //echo "Connected successfully";
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
?>