<?php
//--- taking data by post--------
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
		// ----must insert the category to continue------
        $category =$_POST["category"];
        if ($category > 0) {
      try{
		//   ---making the connection---------
		include_once("includes/conn.php");
		// SQL sentence to insert data into the database---------
        $sql = "INSERT INTO `news`( `userDate`, `title`, `content`, `author`, `image`, `category`, `active`) VALUES (?,?,?,?,?,?,?)";
		// ---taking the DATE data in the same form of the database---------
        $newsDate = date('Y-m-d', strtotime($_POST["newsDate"]));
		$title =$_POST["title"];
        $content =$_POST["content"];
        $author =$_POST["author"];
        $active =$_POST["active"];
		if (isset($_POST["active"])) {
			$active = 1 ;
		  }else {
			$active = 0 ;
		  }
		// ---insert image---------
		 include_once("image.php");
	
        $stmt = $conn->prepare($sql);
        $stmt->execute([$newsDate, $title, $content, $author, $image_name, $category, $active]);
		$script = '<script>alert("inserted successfully")</script>';
        echo $script;
       }catch(PDOException $e){
	  echo "Connection failed: " . $e->getMessage();
       }
      }
    }
    // --- select the categories------
    include_once("includes/conn.php");
   $sql1 = "SELECT * FROM `categories`";
   $stmtCat = $conn->prepare($sql1);
   $stmtCat->execute();		

?>
<!-- page content -->
<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Manage News</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
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
									<h2>Add News</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form action="" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data" >
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="News-date">News Date <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" id="News-date" required="required" class="form-control " name="newsDate">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" required="required" class="form-control " name="title">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="content">Content <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="content"  required="required" class="form-control"name="content">Contents</textarea>
											</div>
										</div>
										<div class="item form-group">
											<label for="author" class="col-form-label col-md-3 col-sm-3 label-align">Author <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="author" class="form-control" type="text" name="author" required="required">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" name="active">
												</label>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="image" name="image" required="required" class="form-control" accept="image/*">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Category <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="category" id="">
													<option value=" ">Select Category</option>
                                                    <?php
							                            foreach($stmtCat->fetchAll() as $row){
								                          $categoryName = $row["categoryName"];
								                           $categoryId =$row ["id"];
							                        ?>
													<option value="<?php echo $categoryId ?>"><?php echo $categoryName ?></option>
													<?php
                                                       }
                                                    ?>
												</select>
											</div>
										</div>
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success" name="submit">Add</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->