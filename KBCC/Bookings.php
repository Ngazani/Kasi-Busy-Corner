<?php

include 'config.php';
session_start();

$user_id = $_SESSION['userID'];
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$phoneNo = $_SESSION['phoneNo'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['Book'])){
    $firstName = mysqli_real_escape_string($conn,$_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
    $phoneNo = mysqli_real_escape_string($conn,$_POST['phoneNo']);
    $carName = mysqli_real_escape_string($conn, $_POST['carName']);
    $carColour = mysqli_real_escape_string($conn,$_POST['carColour']);
    $registrationNo = mysqli_real_escape_string($conn, $_POST['reg']);
    $txtDate = mysqli_real_escape_string($conn, $_POST['Date']);
    $Date =str_replace('T',' ',$txtDate);// To format the date
    $serv =  mysqli_real_escape_string($conn,$_POST['serv']);

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
 
 }
 

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>KCC - Kasi Corner Carwash</title>
    	<meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<!-- 
Flex Template 
https://templatemo.com/tm-406-flex
-->
         <!-- custom css file link  -->
         <link rel="stylesheet" href="css/style.css">
         <!-- font awesome cdn link  -->
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
         <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
         <link rel="stylesheet" href="css/bootstrap.min.css">
         <link rel="stylesheet" href="css/font-awesome.css">
         <link rel="stylesheet" href="css/animate.css">
         <link rel="stylesheet" href="css/templatemo_misc.css">
         <link rel="stylesheet" href="css/templatemo_style.css">

        <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
    </head>
    <body>
        
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
<?php  include "Header.php"?> 

        <div class="content-section" id="contact">
            <div class="container">
                <div class="row">
                    <div class="heading-section col-md-12 text-center">
                        <h2>Bookings</h2>
                        <p>Let us know when you want to bring your car in for a wash</p>
                    </div> <!-- /.heading-section -->
                </div> <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                     <div class="googlemap-wrapper">
                     <div class="mapouter"><div class="gmap_canvas"><iframe width="1080" height="399" id="gmap_canvas" src="https://maps.google.com/maps?q=16%20Dabula%20Dr%20Sharpville&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net"></a><br><style>.mapouter{position:relative;text-align:right;height:399px;width:1080px;}</style><a href="https://www.embedgooglemap.net">embedgooglemap.net</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:399px;width:1080px;}</style></div></div>
                        </div> <!-- /.googlemap-wrapper -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
                <div class="row">
                    <div class="col-md-7 col-sm-6">
                        <p>Kindly Note that all prices are inclusive of VAT and that they may vary from car to car depending on the weight class. <br>
                        </p>
                        <ul class="contact-info">
                            <li>Phone:082 729 7757 / 068 530 1330</li>
                            <li>Email: <a href="info@kasibusycorner.com">info@kasibusycorner.com</a></li>
                            <li>Address: 16 Dabula, Sharpville , South Africa</li>
                        </ul>
                        <!-- spacing for mobile viewing --><br><br>
                    </div> <!-- /.col-md-7 -->
                    <div class="col-md-5 col-sm-6">
                        <div class="contact-form">
                            <form method="post" action="" id="Book">
                                <p>
                                    <input name="firstName" type="text" id="firstName" value=<?php echo $firstName?> >
                                </p>
                                <p>
                                    <input name="lastName" type="text" id="lastName" value= <?php echo $lastName?> >
                                </p>
                                <p>
                                    <input name="phoneNo" type="number" id="phoneNo" value=<?php echo $phoneNo ?>> 
                                </p>
                                <p>
                                    <input name="carName" type="text" id="carName" placeholder="Name Of Your Car"> 
                                </p>
                                <p>
                                    <input name="carColour" type="text" id="carColour" placeholder="Colour Of Your Car"> 
                                </p>
                                <p>
                                    <input name="reg" type="text" id="reg" placeholder="Registration (Number plate)"> 
                                    <span class="label" > Please put a valid number plate no space></span>
                                </p>
                                <input name="Date" type="datetime-local" id="Date" > 

                                <p>
                                <label for="serv">Select A Carwashing Service:</label>
                                <select name="serv" id="serv">
                                    <option value="Exterior">Exterior Only - R150</option>
                                    <option value="Interior">Interior Only - R150</option>
                                    <option value="Internal+External">Inside Out  - R200</option>
                                    <option value="Mags and tires">Mags and Tyres - R70</option>
                                    <option value="Polish">Wash and Polish- R350</option>
                                    <option value="Engine Clean">Engine Clean - R50</option>
                                    <option value="Full Service">Full Service - R500 </option>
                                </select> 
                                </p>
                                <label for="method">Select A Payment Method:</label>
                                <select name="method" id="method">
                                    <option value="cash">Cash </option>
                                    <option value="card">Card </option>
                                </select> 
                                </p>
                                <input type="submit" class="mainBtn" name="Book" value="Book">
                            </form>
                        </div> <!-- /.contact-form -->
                    </div> <!-- /.col-md-5 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /#contact -->
            
        <div id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-xs-12 text-left">
                    
                  </div> <!-- /.text-center -->
                    <div class="col-md-4 hidden-xs text-right">
                        <a href="#top" id="go-top">Back to top</a>
                    </div> <!-- /.text-center -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /#footer -->
        
        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/bootstrap.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Map -->
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="js/vendor/jquery.gmap3.min.js"></script>
        
        <!-- Google Map Init-->
        <script type="text/javascript">
            jQuery(function($){
                $('#map_canvas').gmap3({
                    marker:{
                        address: '37.769725, -122.462154' 
                    },
                        map:{
                        options:{
                        zoom: 15,
                        scrollwheel: false,
                        streetViewControl : true
                        }
                    }
                });

                /* Simulate hover on iPad
                 * http://stackoverflow.com/questions/2851663/how-do-i-simulate-a-hover-with-a-touch-in-touch-enabled-browsers
                 --------------------------------------------------------------------------------------------------------------*/ 
                $('body').bind('touchstart', function() {});
            });
        </script>
        <!-- templatemo 406 flex -->

        <?php include 'footer.php'; ?>

        <!-- custom js file link  -->
<script src="js/script.js"></script>
    </body>
</html>