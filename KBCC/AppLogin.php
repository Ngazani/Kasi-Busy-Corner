<?php   require_once "config.php";
 
 $email = $_POST['email'];
 $password = md5($_POST['password']);

 $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'") or die('query failed');


 $result=array();

 if(mysqli_num_rows($query) > 0){
     while( $row = mysqli_fetch_array($query))
     array_push($result,array("userID"=>$row[0],"firstName"=>$row[1],"lastName"=>$row[2],"phoneNo"=>$row[4]));

   if($result){
      echo json_encode($result);
   }

 }else{
     echo "Error Login!";
 }
  ?>