<?php
// ----MAKING THE CONNECTION----------
include_once("includes/conn.php");
	$status = false ;
if (isset($_GET["id"])) { 
	$id =$_GET["id"];
    $status = true ;
}elseif ($_SERVER["REQUEST_METHOD"] === "POST"){
	 $status = true ;
	 $id =$_POST["id"];
	 $editeCategory = $_POST["editeCategory"];
     

    //--SQL SENTENCE TO UPDATE-- UPDATE THE SELECTED CATEGORY--------
	 $sql = "UPDATE `categories` SET`categoryName`=? WHERE id =?";
     $stmt = $conn->prepare($sql);
     $stmt->execute([$editeCategory, $id]);
	 echo '<script>alert("updated successfully")</script>';
     
}

if ($status) {
 try{
       // ---GET DATA FROM DATABASE FOR THE REQUIRED category-----
     $sql = "SELECT * FROM `categories` WHERE id = ?";
     $stmtShow = $conn->prepare($sql);
     $stmtShow->execute([$id]);
       // SHOWEN DATA ON THE WEBSITE
	 $result = $stmtShow->fetch();
	 $showCategory = $result["categoryName"];
     
 }catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
 }
}
?>
