<?php

//    echo "<script>window.location.href = './login.php';</script>";

include("../config/db.php");

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
  $sms = isset($_POST['sms']) ? 1 : 0;
  $customer_name = $_SESSION['customer_name'];

  global $conn;
  $add_customer_query = "INSERT INTO `customers` (`id`, `name`, `phone`, `allow_promotions`, `created_at`) VALUES (NULL, '$customer_name', '$customer_mobile_number', '$sms', current_timestamp());";
  mysqli_query($conn,$add_customer_query);


}elseif(isset($_POST['skip'])){
  $_SESSION['customer_name'] = "User";
  $_SESSION['customer_mobile_number'] = "No Number";

}

// -------------------------------------------------------------------------------------

if (isset($_GET['prdct-id'])) {




    $table_id = $_SESSION["table_number"];
    $product_id = $_GET['prdct-id'];
    $quantity = 1;
    $customer_name = $_SESSION['customer_name'] ?? null;
    $customer_mobile = $_SESSION['customer_mobile_number'] ?? null;

    // Check if cart session exists
    $check_session_sql = "SELECT id FROM cart_sessions WHERE table_id = '$table_id' ORDER BY created_at DESC LIMIT 1";
    $result = mysqli_query($conn, $check_session_sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $cart_session_id = $row['id'];
    } else {
        // Create new cart session
        $insert_session_sql = "INSERT INTO cart_sessions (table_id, customer_name, customer_mobile) 
                            VALUES ('$table_id', '$customer_name', '$customer_mobile')";
        if (mysqli_query($conn, $insert_session_sql)) {
            $cart_session_id = mysqli_insert_id($conn);
        } else {
            die("Error creating cart session: " . mysqli_error($conn));
        }
    }

    // Check if product already in cart
    $check_cart_sql = "SELECT id FROM cart_items WHERE cart_session_id = '$cart_session_id' AND product_id = '$product_id'";
    $cart_result = mysqli_query($conn, $check_cart_sql);

    if (mysqli_num_rows($cart_result) > 0) {
        // Update quantity
        $update_sql = "UPDATE cart_items 
                    SET quantity = quantity + $quantity 
                    WHERE cart_session_id = '$cart_session_id' AND product_id = '$product_id'";
        mysqli_query($conn, $update_sql);
    } else {
        // Insert new item
        $insert_item_sql = "INSERT INTO cart_items (cart_session_id, product_id, quantity)
                            VALUES ('$cart_session_id', '$product_id', '$quantity')";
        mysqli_query($conn, $insert_item_sql);
    }

    // Get total items in cart
    $count_sql = "SELECT SUM(quantity) as total_items FROM cart_items WHERE cart_session_id = '$cart_session_id'";
    $count_result = mysqli_query($conn, $count_sql);
    $cart_count = 0;
    if ($count_result && mysqli_num_rows($count_result) > 0) {
        $count_row = mysqli_fetch_assoc($count_result);
        $cart_count = $count_row['total_items'];
    }

    $_SESSION['cart_count'] = $cart_count;

    echo "<script>
        window.alert('Item added to cart.cart count $cart_count');
        window.location.href = '?category=11';
    </script>";
}


// -------------------------------------------------------------------------------------

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
        <div class="cart"><i class="fa-solid fa-cart-shopping <?php if(isset( $_SESSION['cart_count'])){echo "fa-beat";}?>"><div class="cartdot"><?php if(isset( $_SESSION['cart_count'])){echo $_SESSION['cart_count'];}else{echo"0";} ?></div></i></div>
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
          <input type="checkbox" name="sms" value="1" />
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
