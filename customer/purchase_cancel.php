
<?php include("Interface/header.php")?>
<?php
    $current_file_name = basename($_SERVER['PHP_SELF']); 
?>

    <div class="row mt-5">
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
                        <a class="nav-link text-reset" href="cust_purchase.php">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="purchase_topay.php">To Pay</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="purchase_toreceive.php">To Receive</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="purchase_completed.php">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="purchase_cancel.php">Cancelled</a>
                    </li>
                </ul>
            </div>
            <div class="row p-3 mb-5">
                <?php 
                    //select from order where order status is pending_payment
                    $custID = $_SESSION['Cust_Id'];
                    $query_order = mysqli_query($con,"SELECT * FROM orders WHERE FK_Order_Cust_ID = '$custID' AND Order_Status = 'cancel'");
                    while($result_order = mysqli_fetch_array($query_order)){
                        $Seller_ID = $result_order['FK_Order_Seller_ID'];
                        $Cart_ID = $result_order['FK_Order_Cart_ID'];
                        $Order_ID = $result_order['Order_ID'];
                ?>
                    <div class="row bg-white">
                        <div class="col">
                            <div class="row p-2">
                                <!-- Seller Store Name and status -->
                                <div class="col-8">
                                <?php
                                    $query_seller = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID ='$Seller_ID'");
                                    $result_seller = mysqli_fetch_array($query_seller);
                                    echo $result_seller['Seller_Name'];
                                ?>
                                </div>
                                <div class="col-4 text-end text-danger">
                                    Pending Payment
                                </div>
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
                                        <?php echo $result_product['Product_Name'] ?><br/>
                                        <span style="font-size: 14px;">x<?php echo $result_item['Cart_Item_Qty'] ?></span>
                                    </div>
                                    <div class="col-2 text-end">
                                        RM<?php echo $result_product['Product_SellingPrice'] ?>
                                    </div>
                                    <span class="d-grid mx-auto mt-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                                <?php        
                                    }
                                ?>
                            </div>
                            <div style="background-color: rgb(254, 255, 246);" class="row">
                                <!-- Total Item purchase -->
                                <?php
                                    $query_order = mysqli_query($con,"SELECT * FROM orders WHERE Order_ID = '$Order_ID'");
                                    $result_order = mysqli_fetch_array($query_order);
                                ?>
                                <div class="col pt-4 pb-4">
                                    <span class="float-end">Order Total: <span class="text-danger" style="font-size: 22px;">RM<?php echo $result_order['Order_Amount']; ?></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="height: 15px;" class="row"></div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
<?php include("Interface/footer.php")?>