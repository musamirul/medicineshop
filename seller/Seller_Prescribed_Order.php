<?php include("Interface/header.php"); ?>
<?php include("Message_Notification.php"); ?>
<?php 
    $Seller_ID = $_SESSION['Seller_Id'];
?>
<?php
    //Get Cart_ID where FK_Item_Record_ID is greater than 0 (cart_item table)
    $record_cart_id = array();
    $count = 0;
    $temp_record_cart_id = '';
    $query_record_cart = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Item_Seller_ID ='$Seller_ID' AND FK_Item_Record_ID > '0'");
    while($result_record_cart = mysqli_fetch_array($query_record_cart)){

        if($temp_record_cart_id!=$result_record_cart['FK_Cart_ID']){
            $record_cart_id[$count] = $result_record_cart['FK_Cart_ID'];
            $temp_record_cart_id = $result_record_cart['FK_Cart_ID'];
        }
        $count++;
    }
?>
<div class="row">
    <div class="col-6 bg-white shadow-sm p-3 mb-5 bg-body rounded">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-cart-fill"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Prescribed Order List</span> <br/>
                    <span style="font-size: 14px; color: grey;">View list of customer prescribed order</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2">
            <table id="example" class="display center" style="width: 100%; text-align: center; font-size: 13px;">
                <thead>
                    <tr>
                        <th>Prod. List</th>
                        <th>Customer Name</th>
                        <th>Shipping Method</th>
                        <th>Med. History</th>
                        <th>Cust Record</th>
                        <th>Channel</th>
                        <th>Action</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        
                        //Get ID,Status & Amount from Order Table
                        $query_order = mysqli_query($con,"SELECT * FROM tracking WHERE Tracking_Status ='preparing' AND FK_Tracking_Seller_ID = '$Seller_ID'");
                        while($result_order = mysqli_fetch_array($query_order)){

                            $Cust_ID = $result_order['FK_Tracking_Cust_ID'];
                            //Get name,contact,email from customer table
                            $query_cust = mysqli_query($con,"SELECT * FROM customer WHERE Cust_ID='$Cust_ID'");
                            $result_cust = mysqli_fetch_array($query_cust);

                            //Customer Shipping_address table
                            $query_shipping = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID = '$Cust_ID'");
                            $result_shipping = mysqli_fetch_array($query_shipping);

                            $ship_id = $result_order['FK_Tracking_Ship_ID'];
                            //Get Shipping method from shipping table
                            $query_ship_method = mysqli_query($con,"SELECT * FROM shipping WHERE Shipping_ID='$ship_id'");
                            $result_ship_method = mysqli_fetch_array($query_ship_method);

                            $Order_Cart_ID = $result_order['FK_Tracking_Cart_ID'];
                            $cart_item = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Order_Cart_ID' AND FK_Item_Record_ID > '0' AND FK_Item_Seller_ID ='$Seller_ID'");
                            while($result_cart_item = mysqli_fetch_array($cart_item)){

                                $FK_Record_ID = $result_cart_item['FK_Item_Record_ID'];

                                //Get Item Name
                                $Cart_Product_ID = $result_cart_item['FK_Item_Product_ID'];
                                $query_item_product = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$Cart_Product_ID'");
                                $result_item_product = mysqli_fetch_array($query_item_product);
                                
                                $query_record = mysqli_query($con,"SELECT * FROM record WHERE Record_ID='$FK_Record_ID'");
                                $result_record = mysqli_fetch_array($query_record);


                    ?>
                    <tr>
                        <td><a data-bs-toggle="modal" data-bs-target="#productView<?php echo $Order_Cart_ID; ?>" href="">#<?php echo $result_order['FK_Tracking_Order_ID']; ?></a></td>
                        <td><?php echo $result_cust['Cust_Name']; ?></td>
                        <td><?php echo $result_ship_method['Shipping_Method'] ?></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#healthView<?php echo $Cust_ID; ?>" href="">View</a></td>
                        <td><a href="javascript:void(0)" onclick="openPdf('../customer/upload/<?php echo $result_record['Record_File']; ?>')">View</a></td>
                        <td>
                        <form method="post">
                            <select style="font-size: 13px;" class="form-select" name="shipOption">
                                <option value="skynet">Skynet Express</option>
                                <option value="citylink">CityLink</option>
                                <option value="dhl">DHL Express</option>
                                <option value="postlaju">Post Laju</option>
                                <option value="gdex">GDex</option>
                                <option value="j&t">J&T Express</option>
                            </select>
                        </td>
                        <td>
                        <select style="font-size: 13px;" class="form-select" name="actionUpdate">
                                <option value="approve">Approve</option>
                                <option value="decline">Decline</option>
                            </select>
                        </td>
                        <input type="hidden" name="tracking_ID" value="<?php echo $result_order['Tracking_ID']; ?>">
                        <input type="hidden" name="Order_ID" value="<?php echo $result_order['FK_Tracking_Order_ID']; ?>">
                        <td><button type='submit' name='btnApprove' class='btn btn-primary btn-sm'>Update</button></td>
                        </form>
                    </tr>
                    <?php
                        if(isset($_POST['btnApprove'])){
                            $shipOption = $_POST['shipOption'];
                            $actionUpdate = $_POST['actionUpdate'];
                            $trackingID = $_POST['tracking_ID'];
                            $order_ID = $_POST['Order_ID'];
                            date_default_timezone_set("Asia/Kuala_Lumpur");
                            $todayDate = date('d-m-Y');
                            $todayTime = date('h:i:s a');

                            //Get wallet id
                            $query_wallet = mysqli_query($con,"SELECT * FROM wallet WHERE FK_Wallet_Seller_ID='$Seller_ID'");
                            $result_wallet = mysqli_fetch_array($query_wallet);
                            $wallet_id = $result_wallet['Wallet_ID'];

                            //get order amount
                            $query_orderAmount = mysqli_query($con,"SELECT * FROM orders WHERE Order_ID = '$order_ID'");
                            $result_orderAmount = mysqli_fetch_array($query_orderAmount);
                            $order_amount = $result_orderAmount['Order_Amount'];

                            if($actionUpdate=='approve'){
                                $query_updateTracking = mysqli_query($con,"UPDATE tracking SET Tracking_Status='ship',Tracking_Channel='$shipOption' WHERE Tracking_ID = '$trackingID'");

                                $query_shipmentTracking = mysqli_query($con,"INSERT INTO tracking_shipment(Track_Ship_Status, Track_Ship_Date, Track_Ship_Time,FK_Tracking_ID)
                                VALUES ('ship','$todayDate','$todayTime','$trackingID')");
                                $_SESSION['message'] = 'Successfully update shipment';
                                echo '<script>window.location.href="Seller_Prescribed_Order.php?msg=success"</script>';

                            }elseif($actionUpdate=='decline'){
                                //update tracking to cancel
                                $query_updateTracking = mysqli_query($con,"UPDATE tracking SET Tracking_Status='cancel' WHERE Tracking_ID = '$trackingID'");

                                //update tracking_shipment to cancel
                                $query_shipmentTracking = mysqli_query($con,"INSERT INTO tracking_shipment(Track_Ship_Status, Track_Ship_Date, Track_Ship_Time,FK_Tracking_ID)
                                VALUES ('cancel','$todayDate','$todayTime','$trackingID')");

                                //create new transaction for cancel
                                $query_transaction = mysqli_query($con,"INSERT INTO transaction(Transaction_Date, Transaction_Time, Transaction_Type, Transaction_Amount, Transaction_Status, FK_Transaction_Wallet_ID, FK_Transaction_Seller_ID, FK_Transaction_Order_ID) 
                                VALUES ('$todayDate','$todayTime','cancel','$order_amount','completed','$wallet_id','$Seller_ID','$order_ID')");

                                //update Orders to cancel
                                $query_orders = mysqli_query($con,"UPDATE orders SET Order_Status='cancel' WHERE Order_ID = '$order_ID' AND FK_Order_Seller_ID ='$Seller_ID'");

                                //update wallet to refund
                                $newAmount = $result_wallet['Wallet_Amount'] - $order_amount;
                                $query_walletRefund = mysqli_query($con,"UPDATE wallet SET Wallet_Amount='$newAmount' WHERE Wallet_ID = '$wallet_id'");

                                $_SESSION['messageErr'] = 'Shipment have successfully decline';
                                echo '<script>window.location.href="Seller_Prescribed_Order.php?msg=success"</script>';
                            }

                            
                        }
                    ?>
                    <?php

                            }
                           
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-6 bg-white shadow-sm mb-5 bg-body rounded">
        <iframe id="myFrame" style="display:none" width="800" height="800"></iframe>
    </div>
</div>

<div class="modal fade" id="productView<?php echo $Order_Cart_ID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">View Product Order <strong>#<?php echo $Order_Cart_ID ?></strong></h5>
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
                    $Order_Cart_ID;
                    //$Cust_ID;
                    $Seller_ID;

                    $query_cartItem = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID ='$Order_Cart_ID' AND FK_Item_Seller_ID='$Seller_ID'");
                    while($result_cartItem=mysqli_fetch_array($query_cartItem)){

                        $Product_ID = $result_cartItem['FK_Item_Product_ID'];
                        $query_product = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$Product_ID'");
                        $result_product = mysqli_fetch_array($query_product);

                ?>
                <div class="row m-2 p-2 <?php if($result_product['Product_RecordType']=='yes'){echo 'bg-warning';} ?>">
                <div style="position:relative" class="col">
                    <img style="height: 6rem; width:6rem;" src="../seller/<?php echo $result_product['Product_Image']; ?>">
                    <?php
                        if($result_product['Product_RecordType']=='yes'){ 
                    ?>
                        <div style="position:absolute; top:-5px; left:10px;color: white; font-size:10px" class="bg-danger p-1">Prescribed medicine</div>
                    <?php
                        }
                    ?>
                </div>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<div class="modal fade" id="healthView<?php echo $Cust_ID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Medical History & Declaration</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-6">
                <?php 
                   $query_medical_history = mysqli_query($con,"SELECT * FROM medical_history WHERE FK_Med_Cust_ID='$Cust_ID'");
                   $result_medical_history = mysqli_fetch_array($query_medical_history);
                   
                ?>
                    <div class="row mt-2 p-2">
                        <div class="d-flex flex-column bd-highlight">
                            <div style="font-size: 20px;" class="p-2 bd-highlight"><?php echo $result_cust['Cust_Name']; ?></div>
                            <div style="font-size: 13px; color: rgb(0, 119, 255);" class="ps-2 bd-highlight"><?php echo $result_cust['Cust_Phone']; ?></div>
                            <div style="font-size: 13px; color: rgb(0, 119, 255);" class="ps-2 bd-highlight"><?php echo $result_cust['Cust_Email']; ?></div>
                        </div>
                        <div class="d-flex flex-row bd-highlight mb-3">
                            <div style="font-size: 13px; color:grey;" class="p-2 bd-highlight">Date of Birth : <?php echo $result_cust['Cust_DOB']; ?></div>
                            <div style="font-size: 13px; color: grey;" class="p-2 bd-highlight">Gender : <?php echo $result_cust['Cust_Gender']; ?></div>
                        </div>
                        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
    
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Blood Group:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Blood_Group']; ?></div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Weight:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Weight']; ?>kg</div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Height:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Height']; ?>cm</div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">BMI:</div>
                        <div class="col float-start"><?php echo $result_medical_history['BMI']; ?>cm</div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Drinking Alcohol?:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Alcohol']; ?></div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Smoking?:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Smoking']; ?></div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Regularly Exercise?:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Exercise']; ?></div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Previous & Current Illness:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Illness']; ?></div>
                    </div>
                    <div style="font-size: 13px" class="row ps-3 pb-2">
                        <div class="col-3">Previous & Current Surgery:</div>
                        <div class="col float-start"><?php echo $result_medical_history['Surgery']; ?></div>
                    </div>
                    <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                    <div class="row mt-3">
                        <span style="font-size: 20px;" >Declaration Files</span>
                        <div style="padding: 20px;" class="row shadow bg-body rounded">
                        <table id="example" class="display center" style="width: 100%; text-align: center;">
                            <thead>
                              <tr>
                                <th>Record ID</th>
                                <th>Types</th>
                                <th>Files Name</th>
                                <th>TimeStamp</th>
                                <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $query_showDoc = mysqli_query($con,"SELECT * FROM declaration WHERE FK_Declaration_Cust_ID = '$Cust_ID'");
                                    while($result_showDoc = mysqli_fetch_array($query_showDoc)){
                                        $name = $result_showDoc['Declaration_FileName'];   
                                ?>
                                <tr>
                                    <td><?php echo $result_showDoc['Declaration_ID']?></td>
                                    <td><?php echo $result_showDoc['Declaration_Name']?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $result_showDoc['Declaration_TimeStamp']?></td>
                                    <td><a href="../customer/cust_declaration-download.php?filename=<?php echo $name;?>&f=<?php echo $result_showDoc['Declaration_File']?>"><button>Download</button></a></td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    </div>
                </div>
                <div class="col-sm-6">
                   
                </div>

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