<?php

include 'config.php';

if(isset($_POST['book'])){
   $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
   $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phoneNo = mysqli_real_escape_string($conn, $_POST['phoneNo']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
            $lastid = mysqli_query($conn, "SELECT * FROM `users`") or die('xolo');//to find out last id
            $row = mysqli_num_rows($lastid);
            $i=$row+1;
            $userID = $i;
    
         mysqli_query($conn, "INSERT INTO `users`(userID,firstName,lastName, email,phoneNo, password) VALUES('$userID','$firstName','$lastName','$email','$phoneNo', '$cpass')") or die('imangine');

         $message[] = 'registered successfully!';
        
         header('location:login.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/templatemo_misc.css">
        <link rel="stylesheet" href="css/templatemo_style.css">
        <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
   
</head>
<body>



<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   <?php include 'header.php'?>
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text"     name="firstName"  placeholder="enter your first name"  required class="box">
      <input type="text"     name="lastName"  placeholder="enter your last name"  required class="box">
      <input type="email"    name="email" placeholder="enter your email" required class="box">
      <input type="Phone"    name="phoneNo" placeholder="enter your number" required class="box">
      <input type="password" name="password"  placeholder="enter your password"   required class="box">
      <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
      <input type="submit"   name="book" value="register now" class="btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>