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
