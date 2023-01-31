<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<table class="table"  style="margin-top:1% ;">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Product Name</th>
      <th scope="col">Quantity</th>
      <th scope="col">Price</th>
      <th scope="col">Image</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
  <?php
  session_start();
    include("./navbar.php");
    include("./configuration.php");
    $total=0;
    if(isset($_GET['delete']))
    {
         unset($_SESSION['cart'][$_GET['delete']]);//unset the array position
          
    }
    if(isset($_POST['update']))
    {
      $updateNum = $_POST['quantity'];
      $id = $_POST['productid'];
      $_SESSION['cart']["$id"]=$updateNum;
      //$_SESSION['cart'] is like the array name 
      //["$id"] is the position
      //$updateNum is the new value the array is gonna get. the session value gets updated

    }
    if(isset($_SESSION['cart']))
    {
        $sellerid = $_SESSION['userID'];
        $cart = $_SESSION['cart'];//has quantity(value) and id(index) of product that r in cart
         $keys = array_keys($cart);
         foreach($keys as $id)
         {
          $query = "SELECT * from products where productsID='$id'";
          $result = $conn->query($query);
          $row = $result->fetch_assoc();
          $name = $row['pName'];
          $img = $row['pImage'];
          $price = $row['pPrice'];
          $quantity = $cart["$id"];
          $total += ($quantity * $price);
          echo "<tr>";
                echo "<td>";
                echo  $name;
                echo "</td>";
                echo "<td>";
                echo"<form method='post'>";
                echo "<input type='number' hidden name='productid'  value='$id'/>";
                echo "<input type='number' name='quantity' min='1' value='$quantity' required placeholder='Enter quantity'/>";
                echo "<button type='submit'  name='update' class='btn btn-warning'>Update</button>";
                echo "</form>";
                echo "</td>";
                echo "</td>";
                echo "<td>";
                echo "€$price"; 
                echo "</td>";
                echo "<td>";
                echo "<img src='Uploaded_image/$img' height='100'>";
                echo "</td>";
                echo "<td>";
                echo "<a href='shoppingCart.php?delete=$id&currNavigation=shoppingCart' style='color: white; width:100;' height='100'><button type='button' class='btn btn-danger btn-block'>Delete</button></a>";
                echo "</td>";
               echo "<tr/>";
         }
         
    }

?>
  </tbody>
  </table>
  <h1>YOUR TOTAL: <?php echo"€$total"?></h1>
  <form method="post">
  <button type='submit' name='addWishList' class='btn btn-primary'>Save Cart to Wish list</button>
  </form>
  <?php
  //adding to wishlist 
  if(isset($_POST["addWishList"])&&isset( $_SESSION['cart']))
  {
      $delete = "DELETE from wishlist where fkuserID='$sellerid'";
      $conn->query($delete);
    foreach($keys as $id)
    {
      $quantity=$cart["$id"];
      $query = "INSERT into wishlist(fkproductID,fkuserID,quantity) Values('$id','$sellerid','$quantity')";
      $result = $conn->query($query);
    }
  }

  $conn->close();
  ?>
  

</div>



