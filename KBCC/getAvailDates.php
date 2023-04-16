<?php   
require_once "config.php";
 
 $date = $_POST['date'];

 $state= mysqli_query($conn,"Select ADDTIME('$Date','0:45:0') as taken");
    $End = mysqli_fetch_assoc($state);
    $last= $End['taken'];

 $select_dates = mysqli_query($conn, "SELECT * FROM `bookings` WHERE Date == $date") or die('Hawu');


 $result=array();

 if(mysqli_num_rows($query) > 0){
     while( $row = mysqli_fetch_array($query))
     array_push($result,array("times" => $row[0]));

   if($result){
      echo json_encode($result);
   }

 }else{
     echo "Error Login!";
 }
  ?>