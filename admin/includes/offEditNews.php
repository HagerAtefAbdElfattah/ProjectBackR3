<?php
//   ---making the connection---------
include_once("includes/conn.php");
	$status = false ;
if (isset($_GET["id"])) { 
	$id =$_GET["id"];
    $status = true ;
    //--- taking data by post--------
}elseif ($_SERVER["REQUEST_METHOD"] === "POST"){
	   $status = true ;
	   $id =$_POST["id"];
     $newsDate=  $_POST ["newsDate"];
	   $title = $_POST["title"];
     $content = $_POST["content"];
     $author = $_POST["author"];
     $category = $_POST["category"];
      if (isset($_POST["active"])) {
	     $active = 1 ;
       }else {
		 $active =0 ;
	   }
    //  ----updating the image--------
	 $oldImage = $_POST["oldImage"];
	 include_once("editImage.php");

    // ----SQL sentence----UPDATE THE SELECTED NEWS-----
	 $sql = "UPDATE `news` SET `userDate`=?,`title`=?,`content`=?,`author`=?,`image`=?,`category`=?,`active`=? WHERE id = ?";
     $stmt = $conn->prepare($sql);
     $stmt->execute([$newsDate, $title, $content, $author, $image_name, $category, $active, $id]);
     $script = '<script>alert("updated successfully")</script>';
	 echo $script ;
   if (isset($script)) {
    header("Location: News.php");
   }
     
}

if ($status) {
 try{
       // ----GET DATA FROM DATABASE FOR THE REQUIRED news---------
     $sql = "SELECT * FROM `news` WHERE id = ?";
     $stmtShow = $conn->prepare($sql);
     $stmtShow->execute([$id]);
       //--- SHOWEN DATA ON THE WEBSITE-----------
	   $result = $stmtShow->fetch();
	   $showNewsDate = $result["userDate"];
     $showTitle=  $result ["title"];
     $showContent=  $result ["content"];
	   $showAuthor=  $result ["author"];
     $showCategory=  $result ["category"];
     $showImage= $result["image"];
     $active =  $result["active"]; 
	 if ($active) {
		$showActive ="checked";
	 }else{
		$showActive = "";
	 }
 }catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
 }
 //----  select the categories-----     
$sql = "SELECT * FROM `categories`";
$stmtCat = $conn->prepare($sql);
$stmtCat->execute();		

}
?>