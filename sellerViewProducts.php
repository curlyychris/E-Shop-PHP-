<?php
include('./configuration.php');
session_start();
$sellerid = $_SESSION['userID'];
$sql = "SELECT * from products where fksellerID=$sellerid";
$result = $conn->query($sql);
if($result->num_rows > 0)
{
  echo "<h2 style='margin-top:1%; margin-bottom:2%; margin-left:6%'>Your Products</h2>";
  echo"<div class='conatiner'>";
  echo"<div class='row'>";
  while($row = $result->fetch_assoc())
  {
    $ids = $row["productsID"];
    $prices=$row["pPrice"];
    $images = $row['pImage'];
    $prices=$row['pPrice'];
    echo"<div class='col-lg-4 mb-3 d-flex align-items-stretch justify-content-center'>";
    echo" <div class='card' style='width: 18rem;'>";
    echo" <img src='./Uploaded_image/$images' class='card-img-top' alt=...>";
    echo"  <div class='card-body d-flex flex-column'>";
    echo' <h5 class="card-title">'.$row['pName'].'</h5>';
    echo'<p class="card-text mb-4">'.$row['pDescription'].'<br><br>'.$row['pNutritionFacts'].'<br><br> €'. $prices .'</p>';
    echo "<p><a href='sellerUpdate.php?edit=$ids'><button type='button' class='btn btn-warning btn-block mt-auto align-self-start'>Edit</button></a></p>";
    echo "<p><a href='sellerViewProducts.php?delete=$ids' style='color: white; width:100;' height='100'><button type='button' class='btn btn-danger btn-block mt-auto align-self-start'>Delete</button></a></p>"; 
    echo '</div>';
    echo'</div>';
    echo" </div>";
  }
  echo"</div>";
    echo "</div>";
}
else
{
  echo ' <div class="jumbotron" >';
  echo ' <h1 class="display-4">You have not added any products</h1>';

  echo '<hr class="my-4">';
  echo '<p>Add products to your store and start selling now!</p>';
  echo '<p class="lead">';
  echo '<a class="btn btn-primary btn-lg" href="./sellerPageAdd.php" role="button">ADD PRODUCTS</a>';
  echo '</p>';
  echo '</div>';
}
if(isset($_GET['delete']))
    {
      $id = $_GET['delete'];
      $sqlWishlist = "DELETE from wishlist where fkproductID=$id";
      mysqli_query($conn, $sqlWishlist);
      $sql = "DELETE from products where productsID=$id";
      mysqli_query($conn, $sql);
      header('Location: ./sellerPageView.php');
    }
$conn->close();
?>


