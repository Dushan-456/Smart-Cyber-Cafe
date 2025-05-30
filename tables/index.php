<?php
// session_start();

// if(!isset( $_SESSION["NIC_num"])){
//    echo "<script>window.location.href = './login.php';</script>";

// }
include("../config/db.php");

// $session_NIC = $_SESSION["NIC_num"];





// -------------Getting user Details-------------------

// global $conn;
// $select_user_query = "SELECT * FROM `employees` WHERE NIC_num	 = '$session_NIC';";
// $result = mysqli_query($conn, $select_user_query);
// $result_row = mysqli_fetch_assoc($result);

// $user_id = $result_row["id"];
// $employee_id = $result_row["employee_id"];
// $first_name = $result_row["first_name"];
// $last_name = $result_row["last_name"];
// $title = $result_row["title"];
// $NIC_num = $result_row["NIC_num"];
// $designation = $result_row["designation"];
// $department = $result_row["department"];
// $EPF_ETF_num = $result_row["EPF_ETF_num"];
// $employee_type = $result_row["employee_type"];
// $marital_status = $result_row["marital_status"];
// $nationality = $result_row["nationality"];
// $gender = $result_row["gender"];
// $address = $result_row["address"];
// $date_of_appointment	= $result_row["date_of_appointment"];
// $birth_day = $result_row["birth_day"];
// $mobile_no_personal = $result_row["mobile_no_personal"];
// $mobile_no_official = $result_row["mobile_no_official"];
// $email_personal = $result_row["email_personal"];
// $email_official = $result_row["email_official"];
// $profile_pic = $result_row["profile_pic"];
// $emp_role = $result_row["emp_role"];
// $theme = $result_row["theme"];


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
  <div class="top">
    <div class="header ">
        <h2>Our Menu</h2>
        <h2>Table 01</h2>
        <div class="cart"><i class="fa-solid fa-cart-shopping fa-beat"><div class="cartdot">2</div></i></div>
      </div>
    
      <div class="tabs">
        <div class="tab active" data-tab="foods">Foods</div>
        <div class="tab" data-tab="drinks">Drinks</div>
        <div class="tab" data-tab="desserts">Desserts</div>
      </div>
</div>

  <!-- Foods Grid -->
  <div class="menu-grid active" id="foods">

  <?php
    
    global $conn;

    $food_category_query = "SELECT * FROM `categories`   WHERE  parent_category = 'Foods'";
    $food_category_result = mysqli_query($conn,$food_category_query);
    while($food_category_result_row = mysqli_fetch_assoc($food_category_result)){

            $id = $food_category_result_row["id"];
            $name = $food_category_result_row["name"];
            $category_image = $food_category_result_row["category_image"];

            echo"
               <div class='food-card'>
                    <a href='#$id'>                    
                    <img src='../assest/images/products/$category_image' alt='$name'>
                    <div class='favorite'><i ></i></div>
                    <h4>$name</h4>
                    </a>

                </div>
            
            ";

                 }

 

  
  ?>

 
  
  </div>

  <!-- drinks Grid -->
  <div class="menu-grid" id="drinks">
    <div class="food-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTI7uXAnhdOWJpu4Maf6a9yjc1RikPvL0nq_Q&s" alt="Fries">
      <div class="favorite"><i class="far fa-heart"></i></div>
      <h4>Fries</h4>
      <p>N800</p>
    </div>
    <div class="food-card">
      <img src="https://via.placeholder.com/150" alt="Onion Rings">
      <div class="favorite"><i class="far fa-heart"></i></div>
      <h4>Onion Rings</h4>
      <p>N900</p>
    </div>
  </div>

  <!-- Desserts Grid -->
  <div class="menu-grid" id="desserts">
    <div class="food-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTI7uXAnhdOWJpu4Maf6a9yjc1RikPvL0nq_Q&s" alt="Chicken Wings">
      <div class="favorite"><i class="far fa-heart"></i></div>
      <h4>Chicken Wings</h4>
      <p>N1,000</p>
    </div>
    <div class="food-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTI7uXAnhdOWJpu4Maf6a9yjc1RikPvL0nq_Q&s" alt="Samosa">
      <div class="favorite"><i class="far fa-heart"></i></div>
      <h4>Samosa</h4>
      <p>N500</p>
    </div>
  </div>


</div>


<!-- // login popup -->
 

<div id="loginModal" class="modal">
  <div class="modal-content">
   
        <div class="form-section">
      <form action="">
            <span class="close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></span>

        <h3>Your Details</h3>
        
        <input type="text" required placeholder="Your Name">
        <input type="text" required placeholder="Mobile Number">
        
        <div class="checkbox-container">
          <input type="checkbox" id="remember" name="remember" />
          <label for="remember">Allow promotion sms</label>
        </div>
        
        <button class="continue" onclick="login()">Continue</button>
      </form>

      <div class="or-divider">or</div>
      <button class="facebook-btn" onclick="closeModal()">Skip</button>
    </div>
  </div>
</div>

<script src="./script.js"></script>


</body>
</html>
