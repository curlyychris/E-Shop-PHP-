<?php
session_start();
if(!isset($_SESSION['userType']))
{
    header('location:./login.php');
}
?>
<head>
    <link rel="stylesheet" href="loginRegister.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php include ('navbar.php');?>

    <div class="col-md-2">
        <div class="content">
            <h2>Welcome <span><?php echo $_SESSION['userType']." ".$_SESSION['usersName']?></span></h2>
        </div>
    </div>
    <?php include ('./customerViewProducts.php');?>

</body>
