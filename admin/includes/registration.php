<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // ----submitting registration
    if (isset($_POST["registerSubmit"])) {
     try{
         include_once("includes/conn.php");
        // ----- SQLsentence------------
        $sql = "INSERT INTO `users`( `name`, `userName`, `email`, `password`) VALUES (?,?,?,?);";
        // -----taking data form the user---------
        $fullname =$_POST["name"];
        $userName =$_POST["userName"];
        $email =$_POST["email"];
        $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
        //-----insert into database-------------
        $stmt = $conn->prepare($sql);
        $stmt->execute([$fullname, $userName, $email, $pass]);
        header("Location: #signin");
        die();
     }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
      }
    }
}      
?>