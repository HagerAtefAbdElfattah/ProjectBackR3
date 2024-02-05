<?php
// ---making the connection------------
 include_once("admin/includes/conn.php");
// ---- taking the data by post----------
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
   try{ 
      //----SQL sentence--- INSERT INTO THE DATABASE-------------
     $sql = "INSERT INTO `contactus`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?);";
     $name =$_POST["name"];
     $email =$_POST["email"];
     $subject =$_POST["subject"];
     $message =$_POST["message"];
     $stmt = $conn->prepare($sql);
     $stmt->execute([$name, $email, $subject, $message]);
     echo '<script>alert("Your message has been sent successfully")</script>';
    }catch(PDOException $e){
   echo "Connection failed: " . $e->getMessage();
    }
 }
?>
<form action="" method="post">
    <div class="form-row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control p-4" placeholder="Your Name" required="required" name="name"/>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="email" class="form-control p-4" placeholder="Your Email" required="required" name="email"/>
            </div>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control p-4" placeholder="Subject" required="required" name="subject"/>
    </div>
    <div class="form-group">
        <textarea class="form-control" rows="4" placeholder="Message" required="required" name="message"></textarea>
    </div>
    <div>
        <button class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;"
            type="submit">Send Message</button>
    </div>
</form>