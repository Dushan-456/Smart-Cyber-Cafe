
     <?php 
       $category = $_GET["category"];
       $category_name_query = "SELECT * FROM `categories`   WHERE  id = '$category'";
       $food_category_name_result = mysqli_query($conn,$category_name_query);
       $category_name_row = mysqli_fetch_assoc($food_category_name_result);
       $category_name = $category_name_row["name"];

     
     ?>
     
     
     
     
     <div class="tabs">
        <div ><a class="back-btn" href="?menu"><i class="fa-solid fa-arrow-left"></i> &nbsp; Back</a></div>
        <div class="tab active"><?php echo $category_name ?></div>
        <div class="tab "></div>
 
      </div>
</div>

  <!-- Meals Grid -->
  <div class="foodmenu active" id="">

  <?php
    
    global $conn;

    $foods_query = "SELECT * FROM `products` WHERE category_id = '$category' ORDER BY `name` ASC";
    $foods_result = mysqli_query($conn,$foods_query);

    if(mysqli_num_rows($foods_result)>0){
    while($foods_result_row = mysqli_fetch_assoc($foods_result)){

            $product_id = $foods_result_row["id"];
            $Product_name = $foods_result_row["name"];
            $product_image = $foods_result_row["image"];
            $product_price = $foods_result_row["price"];

            echo"
             <div class='food-card-menu'>
                  <img src='../assest/images/products/$product_image' alt='$Product_name'>
                        <div>
                          <h4>$Product_name</h4>
                          <p>Rs $product_price</p>
                        </div>
                <div class='buy'><a href='?prdct-id=$product_id'><i class='fa-solid fa-cart-plus'></i></a>
</div>
            </div>
            
            ";

                 }
                }else{
                  echo"
                     <div class='food-card-menu'>
                        <div>
                          <h4>Sorry No any Products in $category_name Category </h4>
                        </div>
                <div class='buy'></div>
            </div>
                  ";
                }

 

  
  ?>

    
   
  </div>