<?php
  session_start();
  include("../includes/config.php");
  if($_SESSION['role']!="seller" || $_SESSION['role']!="seller" || $_SESSION['RegStatus']!= "Active"){
      session_unset();
      header("Location:../Login.php");
  }
  $_SESSION['role'];
  $_SESSION['id'];
  $_SESSION['username'];
  $_SESSION['role'];
  $_SESSION['RegStatus']; 
  $_SESSION['Seller_Id'];
  //Get Current File Name for Navbar active button
  $current_file_name = basename($_SERVER['PHP_SELF']); 

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Interface/style/bootstrap/css/bootstrap.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="Interface/style/css/style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="Interface/style/DataTables/css/jquery.dataTables.css">
    <!--<link rel="stylesheet" href="Interface/style/DataTables/dataTables.bootstrap5.min.css">-->
  </head>
  <body>

<header>
  <!-- Sidebar -->
    	<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        	<div class="position-sticky">
            	<div class="list-group list-group-flush mx-3 mt-4">
                	<a href="Seller_Dashboard.php" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Seller_Dashboard.php") echo "active"?>" aria-current="true"><i class="bi bi-house-door-fill me-3"></i><span>Dashboard</span></a>
                    <a href="#productCollapse" aria-current="true" aria-controls="productCollapse" data-bs-toggle="collapse" aria-expanded="true" class="list-group-item list-group-item-action py-2"><i class="bi bi-bag-fill me-3"></i><span>Product</span></a>
                    
                    <ul class="collapse list-group list-group-flush ps-4" id="productCollapse">
                    	<li class="list-group-item py-1 <?php if($current_file_name== "Seller_Product-Add.php") echo "active"?>"><a href="Seller_Product-Add.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-bag-plus-fill me-3"></i>Add product</a></li>
                        <li class="list-group-item py-1"><a href="#" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-bag-dash-fill me-3"></i>Update product</a></li>
                        <li class="list-group-item py-1 <?php if($current_file_name== "Seller_Product-View.php") echo "active"?>"><a href="Seller_Product-View.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-bag-check-fill me-3"></i>List product</a></li>
                    </ul>
                    
                    
                    <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-cart-fill me-3"></i><span>Order</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-people-fill me-3"></i><span>Customer</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-bar-chart-fill me-3"></i><span>Statistics</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-chat-left-dots-fill me-3"></i><span>Reviews</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-wallet-fill me-3"></i><span>Transaction</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-mailbox2 me-3"></i><span>Tracking</span></a>
                    <br /><br />
                    <a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-gear-fill me-3"></i><span>Settings</span></a>
                </div>       
            </div>
		</nav>

		<nav id="main-navbar" class="navbar navbar-expand-lg shadow-sm navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
              <!-- Toggle button -->
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
              </button>

                  <!-- Brand -->
                  <a class="navbar-brand" href="#">
                    <img class="ms-3" src="Interface/style/image/logo.png" height="30" alt="" loading="lazy" />
                  </a>
              <!-- Right links -->
              <ul class="navbar-nav ms-auto d-flex flex-row">
                <!-- Notification dropdown -->
                <li class="nav-item dropdown">
                  <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Some news</a></li>
                    <li><a class="dropdown-item" href="#">Another news</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                  </ul>
                </li>
                
                <!-- Avatar -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22" alt="" loading="lazy" />
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" >
                    <li><a class="dropdown-item" href="#"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a class="dropdown-item" href="#">My profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
        <!-- Container wrapper -->
      </nav>
    </header>
    <main style="margin-top: 58px">
  <div class="container-fluid ps-5 pe-5 pt-4">