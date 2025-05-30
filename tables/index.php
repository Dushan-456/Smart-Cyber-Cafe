<?php
// session_start();

// if(!isset( $_SESSION["NIC_num"])){
//    echo "<script>window.location.href = './login.php';</script>";

// }
include("../config/db.php");

// $session_NIC = $_SESSION["NIC_num"];
if(isset( $_GET["table"])){
  session_start();
  $_SESSION["table_number"] = $_GET["table"];

}
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$table_number = $_SESSION["table_number"];


if(isset($_POST['submit'])){
  $_SESSION['customer_name'] = $_POST['customer_name'];
  $customer_mobile_number = $_POST['customer_mobile_number'];
  $customer_name = $_SESSION['customer_name'];

}elseif(isset($_POST['skip'])){
  $_SESSION['customer_name'] = "User";

}
// $_SESSION['customer_name']= 'John Doe';

// // $nameSet = "ggg";



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Our Menu</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="./styles.css">

</head>
<body>

<div class="body-container">
<p style="text-align: center;" ><?php if(isset($_SESSION['customer_name'])){ echo "Welcome ",$_SESSION["customer_name"];} ; ?></p>

  <div class="top">

    <div class="header ">
        <h2>Our Menu</h2>
        <h2> Table<?php echo " $table_number";  ?></h2>
        <div class="cart"><i class="fa-solid fa-cart-shopping fa-beat"><div class="cartdot">2</div></i></div>
      </div>
    <!-- -------------------- -->

<?php
if(isset( $_GET["menu"])){
     include("./categories.php");
}
if(isset( $_GET["category"])){
     include("./products.php");
}



?>

  <!-- ------------------------- -->
</div>


<!-- // login popup -->
 

<div id="loginModal" class="modal" style="display: <?php  if(isset($_SESSION['customer_name'])){ echo"none";}else{echo"block";} ; ?>;">
  <div class="modal-content">
   
        <div class="form-section">
      <form action="" method="post">
            <!-- <span class="close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></span> -->

        <h3>Your Details</h3>
        
        <input type="text" name="customer_name" required placeholder="Your Name">
        <input type="text" name="customer_mobile_number" required placeholder="Mobile Number">
        
        <div class="checkbox-container">
          <input type="checkbox" id="remember" name="sms" />
          <label for="sms">Allow promotion sms</label>
        </div>
        
        <button class="continue" name="submit" type="submit" >Continue</button>
      </form>
      <form action="" method="post">
      <div class="or-divider">or</div>
      <button class="facebook-btn" type="submit" name="skip" >Skip</button>
      </form>

    </div>
  </div>
</div>

<script src="./script.js"></script>


</body>
</html>
