<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css">

       

</head>
<body>
   
   <?php 
    include 'admin_header.php'; 
    include 'config.php';
  
   ?>

<!-- admin dashboard section starts  -->

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pending = mysqli_query($conn, "SELECT cost FROM `bookings` WHERE status = 'unconfirmed'") or die('query failed');
            if(mysqli_num_rows($select_pending) > 0){
               while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
                  $total_price = $fetch_pendings['cost'];
                  $total_pendings += $total_price;
               };
            };
         ?>
         <h3>R<?php echo $total_pendings; ?></h3>
         <p>total pendings</p>
      </div>

      <a href= "" ><div class="box">
         <?php
            $total_completed = 0;
            $select_completed = mysqli_query($conn, "SELECT cost FROM `bookings` WHERE status = 'completed'") or die('query failed');
            if(mysqli_num_rows($select_completed) > 0){
               while($fetch_completed = mysqli_fetch_assoc($select_completed)){
                  $total_price = $fetch_completed['cost'];
                  $total_completed += $total_price;
               };
            };
         ?>
         <h3>R<?php echo $total_completed; ?></h3>
         <p>completed payments</p>
      </div> </a>

      <div class="box">
         <?php 
            $select_orders = mysqli_query($conn, "SELECT * FROM `bookings`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Bookings made</p>
      </div>

      
      <div class="box">
         <?php 
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email not like '%@kasibusycorner.com'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>clients</p>
      </div>

      <div class="box">
         <?php 
            $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE email like'%@kasibusycorner.com'") or die('query failed');
            $number_of_admins = mysqli_num_rows($select_admins);
         ?>
         <h3><?php echo $number_of_admins; ?></h3>
         <p>admin users</p>
      </div>

      <div class="box">
         <?php 
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('No new messages');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>Notifications</p>
      </div>

   </div>

</section>

<!-- admin dashboard section ends -->
<?php   include 'admin_footer.php';  ?>
<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>
<script src="js/script.js"></script>


</body>
</html>