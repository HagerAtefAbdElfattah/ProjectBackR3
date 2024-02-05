<?php
// -- making connection-------
 include_once("admin/includes/conn.php");
 try{
    // ---SQL sentence. Having two tables in one sentence to show the category------------
     $sql = "SELECT news.id, news.userDate, news.title, news.content,news.author, news.image, news.category, news.active ,categories.categoryName FROM news INNER JOIN categories ON news.category= categories.id WHERE news.active=1";
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     
 }catch(PDOException $e){
     echo "Connection failed: " . $e->getMessage();
   }

?>
    
        
<?php
                 foreach($stmt->fetchAll()as $row){
                    $date=  $row ["userDate"];
                    $title = $row["title"];
                    $category = $row["category"];
                    $categoryName = $row["categoryName"];
                    $image =  $row["image"];
                    $id = $row["id"];
                    $active = $row["active"];

?>
     <div class="col-lg-6">
        <div class="d-flex align-items-center bg-white mb-3" style="height: 110px;">
            <img class="img-fluid" src="img/<?php echo $image ?>" alt="" width="110p" height="110p">
            <div class="w-100 h-100 px-3 d-flex flex-column justify-content-center border border-left-0">
                <div class="mb-2">
                            
                    <a class="badge badge-primary text-uppercase font-weight-semi-bold p-1 mr-2" href=""><?php echo $categoryName ?></a>
                            
                    <a class="text-body" href=""><small><?php echo $date ?></small></a>
                </div>
                <a class="h6 m-0 text-secondary text-uppercase font-weight-bold" href="single.php?id=<?php echo $id ?>"><?php echo $title ?></a>
            </div>
        </div>
    </div>
   
<?php
                    
                 }
?>