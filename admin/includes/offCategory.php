 <?php
 try{
  // ---making the connection----------
    include_once("includes/conn.php");
    // ---SQL sentence-----------
    $sql = "SELECT * FROM `categories`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }
?>
 <!-- page content -->
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Categories</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Categories</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Settings 1</a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Category Name</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <?php
                           foreach($stmt->fetchAll()as $row){
                            $categoryName =  $row["categoryName"];
                            $id = $row["id"];
                         ?>
                      <tbody>
                        <tr>
                          <td><?php echo $categoryName ?></td>
                          <td><a href = "../admin/editCategory.php?id=<?php echo $id ?>"><img src="./images/edit.png" alt="Edit" ></a></td>
                          <td><a href = "../admin/includes/deleteCategory.php?id=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete?')"><img src="./images/delete.png" alt="Delete"></a></td>
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
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->