<?php
session_start();
include('./configuration.php');
$id = $_GET['edit'];
if(isset($_POST['UpdateProducts']))
{
  $fkSellerid= $_SESSION['userID'];
  $currentTimeDate=date("Y-m-d H:i:s",time());
  $productName = $_POST['foodName'];
  $productDescription = $_POST['foodDescription'];
  $nutritionInfo = $_POST['nutritionFacts'];
  $productPrice = $_POST['foodPrice'];
  if(!empty($_FILES['file']['name'])){
    $fileName = basename($_FILES['file']['name']);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'jpeg', 'png');
      if(in_array($fileType,$allowTypes) && isset($fileName)&& !empty($fileName))
      {
        $image=$_FILES['file']['tmp_name'];
        $productImageFolder = './Uploaded_image/' . $fileName; //if it was 2 directories back ../
        $sql = "UPDATE products set pName='$productName', pDescription='$productDescription', pNutritionFacts='$nutritionInfo', pPrice='$productPrice', pImage='$fileName', pTimeStamp='$currentTimeDate',fksellerID='$fkSellerid' where productsID='$id'";
        $dbUpload = $conn->query($sql);
          if($dbUpload)
          {
            move_uploaded_file($image, $productImageFolder);//puts the picture in the Uplpoaded_image folder 
                header('Location: ./sellerPageAdd.php');
          }
          else
          {
            echo 'UNSUCCESSFUL';
          }
      }
      else
      {
        $error[] = 'Images have to be either jpeg/jpg/png';
      }
  }   
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="./product.css">
<div class="wrapper fadeInDown">
    <div id="formContent">
        <div class="form-container">
            <?php
            $select = mysqli_query($conn, "SELECT * from products where productsID=$id");
            $row = $select->fetch_assoc();
            $names = $row['pName'];
            $descriptions = $row['pDescription'];
            $facts = $row['pNutritionFacts'];
            $prices = $row['pPrice'];
            

            echo'<form method="POST" enctype="multipart/form-data">';
            
                    //picture error about format being only png jpeg and jpg
                    if (isset($error)) {
                        foreach ($error as $error) {
                            echo "<span class='error-messages'>" . $error . '</span>';
                        }
                    }
              
           echo' <h2 class="addproducts" style="margin-bottom: 20px;">UPDATE PRODUCT<br></h2>';
           echo" <input type='text'  required  name='foodName' value='$names' 'placeholder='Enter food name'>";
           echo"<input type='text' required name='foodDescription' value='$descriptions' placeholder='Enter food description'>";
           echo"<input type='text'  required name='nutritionFacts' value='$facts' placeholder='Enter nutritional facts'>";
           echo"<input type='number' required style='text-align: center;' value='$prices' style='margin-bottom: 30px;' min='1' name='foodPrice' step=0.01 placeholder='Enter food price'>";
           echo"<input type='file' accept='.png, .jpeg, .jpg' name='file' required style='margin-left: 130x; margin-top: 20px; margin-bottom:30px'>";
           echo'<input type="submit" name="UpdateProducts"  value="UPDATE product">';
           echo'<a href="./sellerPageView.php?currNavigation=viewPage"><input type="button" value="GO BACK"></a>';
            echo' </form>';

        echo'</div>';
        echo'</div>';
        echo '</div>';
            $conn->close();
?>
