<?php include("Interface/header.php")?>
<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['id']==""){
        header("location:http://localhost/medicineshop/login.php");
    }
    $_SESSION['id'];
    $_SESSION['username'];
    $_SESSION['role'];
    $_SESSION['Cust_Id'];
    $current_file_name = basename($_SERVER['PHP_SELF']); 
?>

    <div class="row">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <?php include("Interface/sidebar.php") ?>
        </div>
        <!-- Purchase table -->
        <div class="col-6">
            <div class="row bg-white mb-3 p-3">
                <ul class="nav nav-pills d-flex justify-content-evenly">
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="cust_purchase.php">To Pay</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="#">To Ship</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="purchase_toreceive.php">To Receive</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="#">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="#">Cancelled</a>
                    </li>
                </ul>
            </div>
            <div class="row bg-white p-3 mb-5">
                <?php 
                    //select from tracking where tracking status is not delivered
                    $custID = $_SESSION['Cust_Id'];
                    $query_tracking = mysqli_query($con,"SELECT * FROM tracking WHERE FK_Tracking_Cust_ID = '$custID' AND Tracking_Status <> 'delivered'");
                    while($result_tracking = mysqli_fetch_array($query_tracking)){
                        $Seller_ID = $result_tracking['FK_Tracking_Seller_ID'];
                        $Cart_ID = $result_tracking['FK_Tracking_Cart_ID'];
                ?>
                    <div class="row">
                        <div class="row p-2">
                            <!-- Seller Store Name and status -->
                            <?php
                                $query_seller = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID ='$Seller_ID'");
                                $result_seller = mysqli_fetch_array($query_seller);
                                echo $result_seller['Seller_Name'];
                            ?>
                        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                        </div>
                        <div class="row">
                            <!-- Product List -->
                            <?php
                                $query_item = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Cart_ID' AND FK_Item_Seller_ID ='$Seller_ID'");
                                while($result_item = mysqli_fetch_array($query_item)){
                                    //select product
                                    $Product_ID = $result_item['FK_Item_Product_ID'];
                                    $query_product = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$Product_ID'");
                                    $result_product = mysqli_fetch_array($query_product);
                            ?>
                                <div class="col-2">
                                    <img style="height: 6rem; width:6rem;" src="../seller/<?php echo $result_product['Product_Image']; ?>">
                                </div>
                                <div class="col-8">
                                    <?php echo $result_product['Product_Name'] ?>
                                </div>
                                <div class="col-2">
                                    RM<?php echo $result_product['Product_SellingPrice'] ?>
                                </div>
                                <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                            <?php        
                                }
                            ?>
                        </div>
                        <div class="row">
                            <!-- Total Item purchase -->
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
<?php include("Interface/footer.php")?>