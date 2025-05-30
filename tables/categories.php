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

            $category_id = $food_category_result_row["id"];
            $name = $food_category_result_row["name"];
            $category_image = $food_category_result_row["category_image"];

            echo"
               <div class='food-card'>
                    <a href='?category=$category_id'>                    
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
   <?php
    
    global $conn;

    $food_category_query = "SELECT * FROM `categories`   WHERE  parent_category = 'Drinks'";
    $food_category_result = mysqli_query($conn,$food_category_query);
    while($food_category_result_row = mysqli_fetch_assoc($food_category_result)){

            $id = $food_category_result_row["id"];
            $name = $food_category_result_row["name"];
            $category_image = $food_category_result_row["category_image"];

            echo"
               <div class='food-card'>
                    <a href='?category=$id'>                    
                    <img src='../assest/images/products/$category_image' alt='$name'>
                    <div class='favorite'><i ></i></div>
                    <h4>$name</h4>
                    </a>

                </div>
            
            ";

                 }

 

  
  ?>

  </div>

  <!-- Desserts Grid -->
  <div class="menu-grid" id="desserts">
    <?php
    
    global $conn;

    $food_category_query = "SELECT * FROM `categories`   WHERE  parent_category = 'Desserts'";
    $food_category_result = mysqli_query($conn,$food_category_query);
    while($food_category_result_row = mysqli_fetch_assoc($food_category_result)){

            $id = $food_category_result_row["id"];
            $name = $food_category_result_row["name"];
            $category_image = $food_category_result_row["category_image"];

            echo"
               <div class='food-card'>
                    <a href='?category=$id'>                    
                    <img src='../assest/images/products/$category_image' alt='$name'>
                    <div class='favorite'><i ></i></div>
                    <h4>$name</h4>
                    </a>

                </div>
            
            ";

                 }

 

  
  ?>

  </div>

