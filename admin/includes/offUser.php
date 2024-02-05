<?php
try{
  // ---making the connection-----
    include_once("includes/conn.php");
    // ---SQL sentence-----
    $sql = "SELECT * FROM `users`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }
?>
<div class="x_content">
<div class="row">
    <div class="col-sm-12">
      <div class="card-box table-responsive">
<table id="datatable" class="table table-striped table-bordered" style="width:100%">
<thead>
  <tr>
    <th>Registration Date</th>
    <th>Name</th>
    <th>Username</th>
    <th>Email</th>
    <th>Active</th>
    <th>Edit</th>
  </tr>
</thead>
      <?php
      // ---displaying data from the DB------
        foreach($stmt->fetchAll()as $row){
          $regDate =  $row["registrationDate"];
          $showDate = date('d M Y',strtotime($regDate) );
          $name =  $row["name"];
          $userName = $row["userName"];
          $email = $row["email"];
          $active =  $row["active"];
          //--- show active with "yes" or "no"-------
            if ($active == 0) {
            $showActive =  "Yes";
            }else {
            $showActive = "No";
            }
          //  ----need the id for the edit button ---------
          $id = $row["id"];
      ?>

<tbody>
  <tr>
    <td><?php echo $showDate ?></td>
    <td><?php echo $name?></td>
    <td><?php echo $userName ?></td>
    <td><?php echo $email ?></td>
    <td><?php echo $showActive ?></td>
    <td><a href="edituser.php?id=<?php echo $id ?>"><img src="./images/edit.png" alt="Edit"></a></td>
  </tr>
</tbody>
      <?php
      }
      ?>
</table>
</div>
</div>
</div>
</div>
