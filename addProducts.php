<?php
session_start();
include('./configuration.php');
if(isset($_POST['submitProducts']))
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
        $sql = "INSERT into products(pName, pDescription, pNutritionFacts, pPrice, pImage, pTimeStamp,fksellerID) VALUES('$productName','$productDescription','$nutritionInfo','$productPrice','$fileName','$currentTimeDate','$fkSellerid')";
        $dbUpload = $conn->query($sql);
          if($dbUpload)
          {
            move_uploaded_file($image, $productImageFolder);//puts the picture in the Uplpoaded_image folder 
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
$conn->close();
?>