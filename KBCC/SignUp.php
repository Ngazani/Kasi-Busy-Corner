<?php

require("config.php");

   $email = $_POST['email'];
   $pass = md5($_POST['password']);
   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
   if(mysqli_num_rows($select_users) > 0){
      echo 'user already exist!';
   }else{
    
     
            $lastid = mysqli_query($conn, "SELECT * FROM `users`") or die('xolo');//to find out last id
            $row = mysqli_num_rows($lastid);
            $i=$row+1;
            $userID = $i;
    
         mysqli_query($conn, "INSERT INTO `users`(userID,email, password) VALUES('$userID','$email','$pass')") or die('imangine');

         echo 'registered successfully!';
    
      
   }

?>