<?php
  session_start();
  include("../includes/config.php");
  if($_SESSION['role']!="administrator"){
      session_unset();
      header("Location:../Login.php");
  }
  $_SESSION['id'];
  $_SESSION['username'];
  $_SESSION['role'];
  $_SESSION['department'];
  $_SESSION['Admin_Id'];
  //Get Current File Name for Navbar active button
  $current_file_name = basename($_SERVER['PHP_SELF']); 
  date_default_timezone_set("Asia/Kuala_Lumpur");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Interface/style/bootstrap/css/bootstrap.min.css" media="screen">
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>-->
    <link href="Interface/style/chosen/chosen.css" rel="stylesheet">
    <link href="Interface/style/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="Interface/style/css/style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="Interface/style/DataTables/css/jquery.dataTables.css">
    <link href="Interface/style/summernote/summernote-lite.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="Interface/style/DataTables/dataTables.bootstrap5.min.css">-->
  </head>
  <body>

<header>
  <!-- Sidebar -->
    	<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        	<div class="position-sticky">
            	<div class="list-group list-group-flush mx-3 mt-4">
                  <?php if($_SESSION['department']!='consultant'){?>
                	<a href="Admin_Dashboard.php" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_Dashboard.php") echo "active"?>" aria-current="true"><i class="bi bi-house-door-fill me-3"></i><span>Dashboard</span></a>

                    <a href="#userCollapse" aria-current="true" aria-controls="userCollapse" data-bs-toggle="collapse" aria-expanded="true" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_ManageSeller.php"||$current_file_name=="Admin_ManageSeller_Active.php"||$current_file_name=="Admin_ManageSeller_Deactive.php"||$current_file_name=="Admin_ManageSeller_ReqApproval.php"||$current_file_name=="Admin_ManageSeller_Suspend.php" || $current_file_name== "Admin_ManageCust.php" || $current_file_name== "Admin_ManageCust_Active.php" || $current_file_name== "Admin_ManageCust_Deactive.php" || $current_file_name== "Admin_ManageCust_Suspend.php" || $current_file_name== "Admin_ManageAdmin.php") echo "active"?>"><i class="bi bi-people-fill me-3"></i><span>User Management</span></a>
                    <ul class="collapse list-group list-group-flush ps-4" id="userCollapse">
                    	<li class="list-group-item py-1 <?php if($current_file_name== "Admin_ManageCust.php") echo "active"?>"><a href="Admin_ManageCust.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-person-fill me-3"></i>Customer</a></li>
                      <li class="list-group-item py-1 <?php if($current_file_name== "Admin_ManageSeller.php"||$current_file_name=="Admin_ManageSeller_Active.php"||$current_file_name=="Admin_ManageSeller_Deactive.php"||$current_file_name=="Admin_ManageSeller_ReqApproval.php"||$current_file_name=="Admin_ManageSeller_Suspend.php") echo "active"?>"><a href="Admin_ManageSeller.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-person-fill me-3"></i>Seller</a></li>
                      <li class="list-group-item py-1 <?php if($current_file_name== "Admin_ManageAdmin.php") echo "active"?>"><a href="Admin_ManageAdmin.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-person-fill me-3"></i>Admin</a></li>
                    </ul>
                  <?php } ?>
                    <a href="#healthCollapse" aria-current="true" aria-controls="healthCollapse" data-bs-toggle="collapse" aria-expanded="true" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_HealthInfo.php"||$current_file_name== "Admin_HealthInfo-view.php"||$current_file_name== "Admin_HealthInfo-manage.php"){echo "active";}?>"><i class="bi bi-journal-album me-3"></i><span>Health Article</span></a>
                    <ul class="collapse list-group list-group-flush ps-4" id="healthCollapse">
                    	<li class="list-group-item py-1 <?php if($current_file_name== "Admin_HealthInfo.php") echo "active"?>"><a href="Admin_HealthInfo.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-journals me-3"></i>Add Article</a></li>
                    	<li class="list-group-item py-1 <?php if($current_file_name== "Admin_HealthInfo-manage.php") echo "active"?>"><a href="Admin_HealthInfo-manage.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-journals me-3"></i>Manage Article</a></li>
                    	<li class="list-group-item py-1 <?php if($current_file_name== "Admin_HealthInfo-view.php") echo "active"?>"><a href="Admin_HealthInfo-view.php" class="text-decoration-none text-reset"><i style="font-size:14px" class="bi bi-journals me-3"></i>View Article</a></li>
                    </ul>
            
                    <a href="Admin_Consultation.php" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_Consultation.php" || $current_file_name== "Admin_Consultation_Request.php" || $current_file_name== "Admin_Consultation_Complete.php" || $current_file_name== "Admin_Consultation_Cancel.php") echo "active"?>" aria-current="true"><i class="bi bi-clipboard me-3"></i><span>Consultation</span></a>
                    <?php if($_SESSION['department']!='consultant'){?>
                      <a href="Admin_ManageShipping.php" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_ManageShipping.php")echo "active"?> " aria-current="true"><i class="bi bi-truck me-3"></i><span>Shipment Method</span></a>
                      <a href="Admin_HelpAssistant.php" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_HelpAssistant.php")echo "active"?> " aria-current="true"><i class="bi bi-question-square me-3"></i><span>Help Assistant</span></a>
                    <?php } ?>
                    <a href="Admin_Information.php" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_Information.php")echo "active"?> " aria-current="true"><i class="bi bi-info-square me-3"></i><span>My Profile</span></a>
                    <?php if($_SESSION['department']=='consultant'){?>
                    <a href="Admin_Consultant_Profile.php" class="list-group-item list-group-item-action py-2 <?php if($current_file_name== "Admin_Consultant_Profile.php")echo "active"?> " aria-current="true"><i class="fa-solid fa-user-doctor me-3"></i><span>Doc Profile</span></a>
                    <?php } ?>
                    <br /><br />
                    <!--<a href="#" class="list-group-item list-group-item-action py-2" aria-current="true"><i class="bi bi-gear-fill me-3"></i><span>Settings</span></a>-->
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
                  <a class="navbar-brand" href="../index.php">
                    <img class="ms-3" src="Interface/style/image/logo.png" height="30" alt="" loading="lazy" />
                  </a>
              <!-- Right links -->
              <ul class="navbar-nav ms-auto d-flex flex-row">
                <!-- Notification dropdown 
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
                </li>-->
                
                <!-- Avatar -->
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle" height="22" alt="" loading="lazy" />
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" >
                    <li><a class="dropdown-item" href="Admin_Dashboard"><?php echo $_SESSION['username']; ?></a></li>
                    <li><a class="dropdown-item" href="Admin_Information">My profile</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                  </ul>
                </li>
              </ul>
            </div>
        <!-- Container wrapper -->
      </nav>
    </header>
    <main style="margin-top: 58px">
  <div class="container-fluid ps-5 pe-5 pt-4">
