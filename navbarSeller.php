<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="logo.jpg" width="150" height="50" alt=""></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php if (isset($_GET['currNavigation']) && ($_GET['currNavigation']) == 'addPage'||(!isset($_GET['currNavigation']))) {echo "active";}?>">
        <a class="nav-link" style="font-weight:bold;" href="./sellerPageAdd.php?currNavigation=addPage">Add products <span class="sr-only"></span></a>
      </li>
      <li class="nav-item <?php if (isset($_GET['currNavigation']) && ($_GET['currNavigation']) == 'viewPage') {echo "active";}?>">
        <a class="nav-link" style="font-weight:bold;" href="./sellerPageView.php?currNavigation=viewPage">View Products</a>
      </li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a style="font-weight:bold; color: black;"  href="./logout.php">LOGOUT</a></li>
    </ul>
  </div>
</nav>



