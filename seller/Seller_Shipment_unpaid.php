<?php include("Interface/header.php"); ?>
<?php 
    $Seller_ID = $_SESSION['Seller_Id'];

    //Count All
    $query_countall = mysqli_query($con,"SELECT count(*) FROM tracking WHERE FK_Tracking_Seller_ID ='$Seller_ID'");
    $result_countall = mysqli_fetch_array($query_countall);
    $allcount = $result_countall[0];

    //Count unpaid
    $query_countunpaid = mysqli_query($con,"SELECT count(*) FROM orders WHERE Order_Status = 'payment_pending' AND FK_Order_Seller_ID = '$Seller_ID'");
    $result_countunpaid = mysqli_fetch_array($query_countunpaid);
    $unpaidcount = $result_countunpaid[0];

    //Count Shipping
    $query_countship = mysqli_query($con,"SELECT count(*) FROM tracking WHERE Tracking_Status = 'ship' AND FK_Tracking_Seller_ID ='$Seller_ID'");
    $result_countship = mysqli_fetch_array($query_countship);
    $shippingcount = $result_countship[0];

    //count Toship
    $query_counttoship = mysqli_query($con,"SELECT count(*) FROM tracking WHERE Tracking_Status ='preparing' AND FK_Tracking_Seller_ID = '$Seller_ID'");
    $result_counttoship = mysqli_fetch_array($query_counttoship);
    $toshipcount = $result_counttoship[0];

    //count completed
    $query_countcomplete = mysqli_query($con,"SELECT count(*) FROM tracking WHERE Tracking_Status ='delivered' AND FK_Tracking_Seller_ID = '$Seller_ID'");
    $result_countcomplete = mysqli_fetch_array($query_countcomplete);
    $completedcount = $result_countcomplete[0];

    //count completed
    $query_countcancel = mysqli_query($con,"SELECT count(*) FROM tracking WHERE Tracking_Status ='cancel' AND FK_Tracking_Seller_ID = '$Seller_ID'");
    $result_countcancel = mysqli_fetch_array($query_countcancel);
    $cancelcount = $result_countcancel[0];
?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-truck"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Shipment Status</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and update your shipment status</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <!-- Purchase table -->
            <div class="col">
                <div class="row bg-white p-3">
                    <ul class="nav nav-pills d-flex justify-content-start">
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment.php"><center>All<span class="shadow badge bg-secondary ms-3"><?php echo $allcount ?></span></center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Seller_Shipment_unpaid.php"><center>Unpaid<span class="shadow badge bg-secondary ms-3"><?php echo $unpaidcount ?></span></center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_toShip.php"><center>To ship<span class="shadow badge bg-secondary ms-3"><?php echo $toshipcount ?></span></center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_shipping.php"><center>Shipping<span class="shadow badge bg-secondary ms-3"><?php echo $shippingcount ?></span></center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_completed.php"><center>Completed<span class="shadow badge bg-secondary ms-3"><?php echo $completedcount ?></span></center></a>
                        </li>
                        <li style="width: 200px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_cancel.php"><center>Cancellation<span class="shadow badge bg-secondary ms-3"><?php echo $cancelcount ?></span></center></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <table id="example" class="display center" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Product Order No</th>
                        <th>Cust Name</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>All Channel</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                        

                        $query_tracking = mysqli_query($con,"SELECT * FROM tracking WHERE FK_Tracking_Seller_ID = '$Seller_ID'");
                        while($result_tracking = mysqli_fetch_array($query_tracking)){
                            
                            $Order_ID = $result_tracking['FK_Tracking_Order_ID'];
                            $Cart_ID = $result_tracking['FK_Tracking_Cart_ID'];
                            $query_order = mysqli_query($con,"SELECT * FROM orders WHERE Order_ID ='$Order_ID'");
                            $result_order = mysqli_fetch_array($query_order);
                            $Cust_ID = $result_order['FK_Order_Cust_ID'];
                            
                            $query_cust = mysqli_query($con,"SELECT * FROM customer WHERE Cust_ID = '$Cust_ID'");
                            $result_cust = mysqli_fetch_array($query_cust);
                    ?>
                    <tr>
                        <td><a data-bs-toggle="modal" data-bs-target="#productView<?php echo $Cart_ID ?>" href="">#<?php echo $result_tracking['FK_Tracking_Order_ID'] ?></a></td>
                        <td><?php echo $result_cust['Cust_Name'] ?></td>
                        <td>RM<?php echo $result_order['Order_Amount'];?></td>
                        <td><?php echo $result_tracking['Tracking_Status'] ?></td>
                        <td><?php echo $result_tracking['Tracking_Channel'] ?></td>
                    </tr>
                    <?php
                        
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Product list -->
<div class="modal fade" id="productView<?php echo $Cart_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">View Product Order <strong>#<?php echo $Order_ID ?></strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
                <div class="row m-2 p-2">
                    <div style="font-weight: bold;" class="col">Image</div>
                    <div style="font-weight: bold;" class="col">Name</div>
                    <div style="font-weight: bold;" class="col">Quantity</div>
                    <div style="font-weight: bold;" class="col">Price</div>
                </div>
                <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <?php 
                    $Cart_ID;
                    $Cust_ID;
                    $Seller_ID;

                    $query_cartItem = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID ='$Cart_ID' AND FK_Item_Seller_ID='$Seller_ID'");
                    while($result_cartItem=mysqli_fetch_array($query_cartItem)){

                        $Product_ID = $result_cartItem['FK_Item_Product_ID'];
                        $query_product = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$Product_ID'");
                        $result_product = mysqli_fetch_array($query_product);

                ?>
                <div class="row m-2 p-2">
                    <div class="col"><img style="height: 6rem; width:6rem;" src="../seller/<?php echo $result_product['Product_Image']; ?>"></div>
                    <div class="col mt-4"><?php echo $result_product['Product_Name'] ?></div>
                    <div class="col mt-4"><?php echo $result_cartItem['Cart_Item_Qty']?> qty</div>
                    <div class="col mt-4">RM <?php echo $result_cartItem['Cart_Item_Amount'] ?></div>
                </div>
                <span class="d-grid mx-auto" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <?php
                    }
                ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
          </div>   
      </div>
    </div>
  </div>

<?php include("Interface/footer.php"); ?>