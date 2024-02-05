<?php
// ---make the session-------
include_once("includes/logged.php");
// ---make the connection-----
include_once("includes/conn.php");
	$status = false ;
if (isset($_GET["id"])) { 
	$id =$_GET["id"];
    $status = true ;
	//--- taking the data by post to update in the database ------
}elseif ($_SERVER["REQUEST_METHOD"] === "POST"){
	 $status = true ;
	 $id =$_POST["id"];
	 $name = $_POST["name"];
     $userName=  $_POST ["user-name"];
     $email = $_POST["email"];
     $password = password_hash($_POST["password"], PASSWORD_DEFAULT); 
      if (isset($_POST["active"])) {
	     $active = 0 ;
       }else {
		 $active = 1 ;
	   }
	// ----updating image------
	    $oldImage = $_POST["oldImage"];
		include_once("includes/editUserImage.php");

    //---- SQL sentence to update the selected user------
	 $sql = "UPDATE `users` SET `name`=?,`userName`=?,`email`=?,`password`=?,`image`=?,`active`=? WHERE `id`=?";
     $stmt = $conn->prepare($sql);
     $stmt->execute([$name, $userName, $email, $password, $image_name, $active, $id]);
	 echo '<script>alert("updated successfully")</script>';
}
if ($status) {
 try{
       // ---GET DATA FROM DATABASE FOR THE REQUIRED user-----
     $sql = "SELECT * FROM `users` WHERE id = ?";
     $stmtShow = $conn->prepare($sql);
     $stmtShow->execute([$id]);
       // ----SHOWEN DATA ON THE WEBSITE-----
	 $result = $stmtShow->fetch();
	 $showName = $result["name"];
     $showUserName=  $result ["userName"];
	 $showEmail=  $result ["email"];
     $showPassword = $result["password"];
	 $showImage =  $result["image"];
     $active =  $result["active"]; 
	 if ($active) {
		$showActive ="";
	 }else{
		$showActive = "checked";
	 }

 }catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
 }
}
?>