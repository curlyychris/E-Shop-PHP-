<?php
include('./addProducts.php');
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="./product.css">
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <img src="logo.jpg" id="icon" alt="Logo Icon" />
    </div>

    <!-- Add items Form for seller -->
    <div class="form-container">
    <form method="POST" enctype="multipart/form-data">
    <?php
    //picture error about format being only png jpeg and jpg
        if(isset($error))
        {
            foreach($error as $error)
            {
                echo "<span class='error-messages'>" . $error . '</span>';
            }
        }                                    
    ?>   
      <h2 class="addproducts" style="margin-bottom: 20px;">ADD PRODUCTS<br></h2>
      <input type="text"  required class="fadeIn second" name="foodName" placeholder="Enter food name">
      <input type="text" required class="fadeIn third" name="foodDescription" placeholder="Enter food description">
      <input type="text"  required class="fadeIn third" name="nutritionFacts" placeholder="Enter nutritional facts">
      <input type="number" required style="text-align: center;" style="margin-bottom: 30px;" class="fadeIn fourth" min="1" name="foodPrice" step=0.01 placeholder="Enter food price">
      <!--accept=".png, .jpeg, .jpg" appears in the custom file when choose file is clicked doesnt stop you from putting any file-->
      <input type="file" accept=".png, .jpeg, .jpg" name="file" required style="margin-left: 130x; margin-top: 20px; margin-bottom:20px" class="fadeIn fourth">
      <input type="submit" class="fadeIn fourth" name="submitProducts"  value="ADD product">
    </form>
    </div>
  </div>

  <table class="table"  style="margin-top:1% ;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Description</th>
      <th scope="col">Nutritional Facts</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    include("./configuration.php");
    $sellerid = $_SESSION['userID'];
    $sql = "SELECT * from products where fksellerID=$sellerid";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $images = $row['pImage'];
          $prices=$row["pPrice"];
          $ids = $row["productsID"];
            echo "<tr>";
            echo "<td>";
            echo  $row["pName"];
            echo "</td>";
            echo "<td>";
            echo  $row["pDescription"];
            echo "</td>";
            echo "</td>";
            echo "<td>";
            echo  $row["pNutritionFacts"];
            echo "</td>";
            echo "<td>";
            echo "€$prices"; 
            echo "</td>";
            echo "<td>";
            echo "<img src='Uploaded_image/$images' height='100'>";
            echo "</td>";
            echo "<td>";
            echo "<p><a href='sellerUpdate.php?edit=$ids;'style='color: black; width:100' height='100'><button type='button'  name='Edit'class='btn btn-warning btn-block'>Edit</button></a></p>";
            echo "<a href='sellerAddProducts.php?delete=$ids;' style='color: white; width:100;' height='100'><button type='button' class='btn btn-danger btn-block'>Delete</button></a>";
            echo "</td>";
           echo "<tr/>";
           
        }
    }
    else 
    {
        echo "<h2 style='margin-top: 30px; color:#0d0d0d'>No Products Have Been Added</h2>";
    } 
    //delete from database when delete is clicked in table of products
    if(isset($_GET['delete']))
    {
      $id = $_GET['delete'];
      $sqlWishlist = "DELETE from wishlist where fkproductID=$id";
      mysqli_query($conn, $sqlWishlist);
      $sql = "DELETE from products where productsID=$id";
      mysqli_query($conn, $sql);
      header('Location: ./sellerPageAdd.php');
    }
    
    $conn->close();
?>
  </tbody>
  </table>
</div>



