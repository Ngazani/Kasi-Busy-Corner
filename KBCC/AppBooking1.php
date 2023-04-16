<?php 

require_once "config.php";

    $firstName =$_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phoneNo = $_POST['phoneNo'];
    $carName = $_POST['carName'];
    $carColour =$_POST['carColour'];
    $registrationNo =$_POST['reg'];
    $txtDate =  $_POST['Date'];
    $Date =str_replace('T',' ',$txtDate);// To format the date
    $serv =  $_POST['serv'];

    //Get costs based on the select
    Switch($serv)
    {
        case "Exterior":
            $cost= 150;
            break;
        case "Interior":
            $cost = 150;
            break;
        case "Internal+External":
            $cost= 200;
            break;
        case "Mags and tires":
            $cost = 70;
            break;
        case "Polish":
            $cost= 350;
            break;
        case "Engine clean":
            $cost = 50;
            break;
        case "Full Service":
            $cost =500;
            break;    
    }

    $method = $_POST['method'];
    $state= mysqli_query($conn,"Select  ADDTIME('$Date','0:45:0') as taken");
    $End = mysqli_fetch_assoc($state);
    $last= $End['taken'];
    
    $select_users = mysqli_query($conn, "SELECT * FROM `bookings` WHERE Date between '$Date' AND '$last'") or die('Hawu');
    
    if(mysqli_num_rows($select_users) > 0){
      echo "Time slot is taken";
    }else{
       
        $lastid = mysqli_query($conn, "SELECT bookingID FROM `bookings` ") or die('xolo');//to find out last id
        $row = mysqli_num_rows($lastid);
        $i=$row+1;
        $bookingID = $i;
        $booked= date("Y-m-d H:i:s");
          mysqli_query($conn, "INSERT INTO `bookings`(bookingID,userID,firstName, lastName, phoneNo, carName,colour,registrationNo,Service,paymentMethod,status,Date,cost,booked) VALUES( '$bookingID','$user_id','$firstName', '$lastName','$phoneNo','$carName','$carColour','$registrationNo','$serv','$method','unconfirmed','$Date','$cost','$booked')") or die('query failed');
          echo $last;
          $message[] = 'registered successfully!';
          header('location:former_Bookings.php');
    
    }
 
 
 ?>