<?php
session_start();
// ----if the session already exist
   if (isset($_SESSION ["user"]) && $_SESSION ["user"]) {
       header("location: users.php");
    die();
   }
    // ----submitting login-----
     if (isset($_POST["loginSubmit"])) {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
         try{
            include_once("includes/conn.php");
            // ------taking data from user by post---------
              $logUsername =$_POST["logUsername"];
              $logPass = $_POST["logPassword"];
            // ------SQLsentence---------  
              $sql = "SELECT * FROM `users` WHERE `userName`=?";
              $stmt = $conn->prepare($sql);
              $stmt->execute([$logUsername]);
              if ($stmt->rowCount() > 0) {
               $result =$stmt->fetch();
               $active =$result["active"];
               $fullname =$result["name"];
               $userName =$result["userName"];
               $email =$result["email"];
               $image =$result["image"];
               $password =$result["password"];
               $verify =password_verify($logPass, $password);
                //  ---if the user is not active
                    if ($active == 0) {
                // -----if the password is wrong             
                      if ($verify) {
                        // -----creating a seesion to call the user's name in every page in the panal---
                             $_SESSION["user"]=[
                              "name" => $fullname,
                              "image" => $image,
                              "userName" => $userName,
                              "email" => $email];
                         // when the session is made, it can go directly to users.php page----
                         $_SESSION["user"] == true ;
                         header("Location: users.php");
                         die();
                }else {
                     echo '<script>alert("password is incorrect")</script>';
                }
                }else{
                  echo '<script>alert("This user is not allowed to login")</script>';
                }
              }else {
                     echo '<script>alert("This username is not found.")</script>';
              }
       
         }catch(PDOException $e){
          echo "Connection failed: " . $e->getMessage();
         }
        }      
      }
?>
