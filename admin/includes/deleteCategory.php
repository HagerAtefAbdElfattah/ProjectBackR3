<?php
include_once("logged.php");
  if (isset($_GET["id"])) {
     try{
       include_once("conn.php");
        $id = $_GET["id"];
        $sql = "DELETE FROM `categories` WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
     }catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
  }
        header("location:../categories.php");
        die();
 }else {
    echo "invaild request";
 }
?>
