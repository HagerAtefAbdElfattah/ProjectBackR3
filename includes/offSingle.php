<?php
// ---making the connection------------
include_once("admin/includes/conn.php");
try{
      // ---SQL sentence. Having two tables in one sentence to show the category------------
    $id =$_GET["id"];
    $sql = "SELECT * ,categories.categoryName FROM news INNER JOIN categories ON news.category= categories.id WHERE news.id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    $result =$stmt->fetch();
    $title =$result["title"];
    $date =$result["userDate"];
    $image =$result["image"];
    $content =$result["content"];
    $author =$result["author"];
    $category =$result["category"];
    $categoryName =$result["categoryName"];
    
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }

?>
<!-- News With Sidebar Start -->
<div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- News Detail Start -->
                    <div class="position-relative mb-3">
                        <img class="img-fluid w-100" src="img/<?php echo $image ?>" style="object-fit: cover;">
                        <div class="bg-white border border-top-0 p-4">
                            <div class="mb-3">
                                <a class="badge badge-primary text-uppercase font-weight-semi-bold p-2 mr-2"
                                    href=""><?php echo $categoryName ?></a>
                                <a class="text-body" href=""><?php echo $date ?></a>
                            </div>
                            <h1 class="mb-3 text-secondary text-uppercase font-weight-bold"><?php echo $title ?></h1>
                            <p><?php echo $content ?></p>
                            
                        </div>
                        <div class="d-flex justify-content-between bg-white border border-top-0 p-4">
                            <div class="d-flex align-items-center">
                                <img class="rounded-circle mr-2" src="img/user.jpg" width="25" height="25" alt="">
                                <span><?php echo $author ?></span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="ml-3"><i class="far fa-eye mr-2"></i>12345</span>
                            </div>
                        </div>
                    </div>
                    <!-- News Detail End -->