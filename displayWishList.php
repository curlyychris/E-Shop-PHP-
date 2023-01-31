<table class="table"  style="margin-top:1% ;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
  <?php
  session_start();
    include("./navbar.php");
    include("./configuration.php");
    $sellerid = $_SESSION['userID'];
      $query = "SELECT * from wishlist inner join products ON fkproductID=productsID where fkuserID='$sellerid'";
      $result = $conn->query($query);
      while($row = $result->fetch_assoc())
      {
        $name = $row['pName'];//once i inner hoined the product table i gained access to its content
      $img = $row['pImage'];
      $price = $row['pPrice'];
      $quantity = $row['quantity'];
    
      echo "<tr>";
            echo "<td>";
            echo  $name;
            echo "</td>";
            echo "<td>";
            echo $quantity;
            echo "</td>";
            echo "</td>";
            echo "<td>";
            echo "€$price"; 
            echo "</td>";
            echo "<td>";
            echo "<img src='Uploaded_image/$img' height='100'>";
            echo "</td>";
           echo "<tr/>";
      }
      
?>
  </tbody>
  </table>
  <form method="post">
  <button type='submit' name='WishListAddedToCart' class='btn btn-primary'>Add Wish list to Cart</button>
  </form>
  <?php
  if(isset($_POST["WishListAddedToCart"]))
  {
    $query = "SELECT * from wishlist where fkuserID='$sellerid'";
      $result = $conn->query($query);
      while($row = $result->fetch_assoc())
      {
          $fkproductID = $row['fkproductID'];
      $quantity = $row['quantity'];
      if(!isset($_SESSION['cart']))
    {
      $_SESSION['cart'] = array();
      
    }
    //if this already exists in my cart it will just increment the quantity when i try to add it again
    if(isset($_SESSION['cart']["$fkproductID"]))
    {
      $_SESSION['cart']["$fkproductID"] += $quantity;//$_SESSION['cart']["$pID"] is the old quantity
    }
    else{
      $_SESSION['cart']["$fkproductID"] = $quantity;
    }
      }
  }
  ?>