<?php

require_once 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);
      $type=explode('@',Strtolower($email));

      if( $type[1]=="kasibusycorner.com" ){

         $_SESSION['admin_name'] = $row['firstName'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['userID'];
         $_SESSION['userType']="Admin";
         header('location:admin_Dashboard.php');
        echo "login Success";

      }elseif($type[1] !=="kasibusycorner.com"){

         $_SESSION['firstName'] = $row['firstName'];
         $_SESSION['lastName'] = $row['lastName'];
         $_SESSION['phoneNo'] = $row['phoneNo'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['userID'] = $row['userID'];
         $_SESSION['userType']="User";
        header('location:Index.php');
        echo "login Success";

      }

   }else{
      $message[] = 'incorrect email or password!';
      echo "login Fail";

   }

}

?>