
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"><div class="dropdown show">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo '';
    if(isset($_GET['name'])||isset($_GET['id']))
    {
        echo $_GET['name'];
    }
    else
        {
            echo '---Choose category---';
        }?>
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
  <a class='dropdown-item' href='./customerPage.php'>All categories</a>
<?php
include('./configuration.php');
//selects only the seller who have products added
$sql = "SELECT DISTINCT id,name from users inner join products ON users.id=products.fksellerID where userType='Seller'";
$result = $conn->query($sql);

if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        $sellerName=$row['name'];
        $id = $row['id'];
        echo "<a class='dropdown-item' href='./customerPage.php?ids=$id&name=$sellerName'>$sellerName</a>";
    }


}
    echo'</div>';
    echo'</div>';
?>

<?php
if(isset($_POST['addCart']))
{
  $pName = $_POST['productname'];
  $pPrice = $_POST['productprice'];
  $pImage = $_POST['productImage'];
  $pQuantity = $_POST['quantity'];
  $pID = $_POST['productID'];
  if(!isset($_SESSION['cart']))
  {
    $_SESSION['cart'] = array();
    
  }
  //if this already exists in my cart it will just increment the quantity when i try to add it again
  if(isset($_SESSION['cart']["$pID"]))
  {
    $_SESSION['cart']["$pID"] += $pQuantity;//$_SESSION['cart']["$pID"] is the old quantity
  }
  else{
    $_SESSION['cart']["$pID"] = $pQuantity;
  }

}

if(isset($_GET['ids']))
{
    $getID = $_GET['ids'];
    $sql = "SELECT * from products where fksellerID='$getID'";

}

else{
    $sql = "SELECT * from products";
}

$result = $conn->query($sql);
if($result->num_rows > 0)
{
  echo"<div class='conatiner'>";
  echo"<div class='row'>";
  while($row = $result->fetch_assoc())
  {
    $ids = $row["productsID"];
    $prices=$row["pPrice"];
    $images = $row['pImage'];
    $prices=$row['pPrice'];
    $name = $row['pName'];
    echo"<div class='col-lg-4 mb-3 d-flex align-items-stretch justify-content-center'>";
    echo" <div class='card' style='width: 18rem;'>";
    echo" <img src='./Uploaded_image/$images' class='card-img-top' alt=...>";
    echo"  <div class='card-body d-flex flex-column'>";
    echo' <h5 class="card-title" style="text-align:center">'.$row['pName'].'</h5>';
    echo'<p class="card-text mb-4" style="text-align:center;">'.$row['pDescription'].'<br><br>'.$row['pNutritionFacts'].'<br><br> €'. $prices .'</p>';
    echo'<form method="post">';
    echo "<input type='number'  hidden name='productID' value='$ids'><br>";
    echo "<input type='number'  hidden name='productprice' value='$prices'><br>"; 
    echo "<input type='text'  hidden name='productname' value='$name'><br>";
    echo "<input type='text'  hidden name='productImage' value='$images'><br>";
    echo "<input type='number' min='1' name='quantity' value='1'><br>"; 
    echo "<button type='submit' name='addCart' class='btn btn-warning'>Add to Cart</button></a>";
    echo '</form>';
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
$conn->close();
?>
