<?php 

include("includes/config.php"); 
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Interface/style/bootstrap/css/bootstrap.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!--<link href="Interface/style/css/style1.css" rel="stylesheet" type="text/css" />-->
    <link rel="stylesheet" type="text/css" href="Interface/style/DataTables/css/jquery.dataTables.css">
    <link href="Interface/style/summernote/summernote-lite.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="Interface/style/DataTables/dataTables.bootstrap5.min.css">-->
  </head>
  <body>

<header>

<nav id="main-navbar" class="navbar navbar-expand-lg shadow-sm navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container">
              <div class="col">
                <div class="row mb-2">
                  <div class="col ps-4">
                    <a style="font-size: 13px; color: rgb(20, 10, 109);" class="text-decoration-none pe-2" href="seller/Seller_Registration.php">Seller Center</a>

                  </div>
                  <div class="col">
                      <!-- Right links -->
                      <ul class="navbar-nav ms-auto float-end">
                        <!-- Notification dropdown -->
                        <?php if(!isset($_SESSION['Cust_Id'])){?>
                          <a class="text-decoration-none text-reset" href="Login.php"><span style="font-size:13px">Login | Register</span></a>
                        <?php }else{?>
                        <li class="nav-item dropdown">
                          <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                            <span style="font-size: 14px;">notification</span>
                            <span class="position-absolute top-30 start-90 translate-middle badge rounded-pill bg-danger">1</span>
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
                            <?php echo $_SESSION['username'];?>
                          </a>
                          
                          <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                            <?php echo $_SESSION['username'];?>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" >
                            <li><a class="dropdown-item" href="#"></a></li>
                            <li><a class="dropdown-item" href="profile.php">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                          </ul>
                        </li>
                        <?php } ?>
                      </ul>
                  </div>
                </div>
                <div class="row">
                <div class="col-2">
                  <img class="ms-3" src="Interface/style/image/logo.png" height="48px" width="130px" alt="" loading="lazy" />
                </div>
                  <div class="col-8 mt-1">
                      <form method="post" action="product-list.php">
                        <div class="input-group mb-3">
                          <input class="form-control" type="text" name="productSearch" placeholder="Search for product, brand and shop">
                          <button class="btn btn-primary" name="searchButton" type="button"><i class="bi bi-search ps-3 pe-3"></i></button>
                        </div>
                      </form>
                  </div>
                  <div class="col-2">
                    <?php if(!isset($_SESSION['Cust_Id'])){?>
                          
                    <?php }else{?>
                      <?php
                            //count cart
                            $count_Cust_ID = $_SESSION['Cust_Id'];
                            $query_countCart = mysqli_query($con,"SELECT count(*) FROM cart WHERE Cart_Status = 'pending' AND FK_Cart_Cust_ID = '$count_Cust_ID'");
                            $result_countCart = mysqli_fetch_array($query_countCart);
                            $cartcount = $result_countCart[0];
                      ?>
                    <a style="font-size: 14px; color: rgb(20, 10, 109);" class="text-decoration-none position-relative" href="cust_shopping_cart.php">
                    <i style="font-size: 30px;" class="bi bi-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $cartcount; ?>
                        <span class="visually-hidden">on cart</span>
                      </span>
                    </a>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <!-- Container wrapper -->
    </nav>
</header>
    <main style="margin-top: 100px">
  <div class="container-fluid ps-5 pe-5 pt-4">