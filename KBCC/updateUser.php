<?php   require_once "config.php";
 
 $email = $_POST['email'];
 $firstName = $_POST['firstName'];
 $lastName = $_POST['lastName'];
 $phoneNo = $_POST['phoneNo'];


 mysqli_query($conn, "UPDATE users SET firstName = '$firstName', lastName = '$lastName', phoneNo = '$phoneNo'WHERE email= '$email'") or die('query failed');

     echo "Save Successful";

 
  ?>