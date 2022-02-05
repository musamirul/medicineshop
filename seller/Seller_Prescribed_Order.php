<?php include("Interface/header.php"); ?>
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
                    <span style="font-size: 23px;font-weight: bold;">Order List</span> <br/>
                    <span style="font-size: 14px; color: grey;">View list of customer order</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2">
            <table id="example" class="display center" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Shipping Method</th>
                        <th>Product</th>
                        <th>Medical History</th>
                        <th>Cust Record</th>
                        <th>Action</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        

                        //Get ID,Status & Amount from Order Table
                        $query_order = mysqli_query($con,"SELECT * FROM orders WHERE FK_Order_Seller_ID='$Seller_ID'");
                        while($result_order = mysqli_fetch_array($query_order)){

                            $Cust_ID = $result_order['FK_Order_Cust_ID'];
                            //Get name,contact,email from customer table
                            $query_cust = mysqli_query($con,"SELECT * FROM customer WHERE Cust_ID='$Cust_ID'");
                            $result_cust = mysqli_fetch_array($query_cust);

                            //Customer Shipping_address table
                            $query_shipping = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID = '$Cust_ID'");
                            $result_shipping = mysqli_fetch_array($query_shipping);

                            $ship_id = $result_order['FK_Order_Ship_ID'];
                            //Get Shipping method from shipping table
                            $query_ship_method = mysqli_query($con,"SELECT * FROM shipping WHERE Shipping_ID='$ship_id'");
                            $result_ship_method = mysqli_fetch_array($query_ship_method);

                            $Order_Cart_ID = $result_order['FK_Order_Cart_ID'];
                            $cart_item = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Order_Cart_ID' AND FK_Item_Record_ID > '0'");
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
                        <td><a data-bs-toggle="modal" data-bs-target="#productView<?php echo $Order_Cart_ID ?>" href="">#<?php echo $result_order['Order_ID']; ?></a></td>
                        <td><?php echo $result_cust['Cust_Name']; ?></td>
                        <td><?php echo $result_ship_method['Shipping_Method'] ?></td>
                        <td><?php echo $result_item_product['Product_Name'] ?></td>
                        <td><a data-bs-toggle="modal" data-bs-target="#healthView<?php echo $Cust_ID ?>" href="">View</a></td>
                        <td><a href="javascript:void(0)" onclick="openPdf('../customer/upload/<?php echo $result_record['Record_File']; ?>')">View</a></td>
                        <td><button type='submit' name='btnApprove' class='btn btn-primary btn-sm'>Approve</button></td>
                        <td><button type='submit' name='btnApprove' class='btn btn-primary btn-sm'>Approve</button></td>
                    </tr>
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

<!-- View Product list -->
<div class="modal fade" id="productView<?php echo $Order_Cart_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
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
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
          </div>   
      </div>
    </div>
  </div>
<!-- View Cust Health -->
<div class="modal fade" id="healthView<?php echo $Cust_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">View Cust Health Status <strong>#<?php echo $Cust_ID ?></strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
                <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <?php 
                   $query_medical_history = mysqli_query($con,"SELECT * FROM medical_history WHERE FK_Med_Cust_ID");
                   $result_medical_history = mysqli_fetch_array($query_medical_history);

                ?>
                <div class="row mt-2 p-2">
                    test
                </div>
                <span class="d-grid mx-auto" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
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