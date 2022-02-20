<?php include("Interface/header.php")?>

<?php
//get customer name and phone number
$quantity = $_GET['quantity'];
$product_ID = $_GET['product_ID'];
$record_id = $_GET['record_id'];


$custID = $_SESSION['Cust_Id'];
$query_customerDetail = mysqli_query($con, "SELECT * FROM customer WHERE Cust_ID = '$custID'");
$result_customerDetail = mysqli_fetch_array($query_customerDetail);

//get customer delivery address
$query_shippingAddress = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID = '$custID'");
$result_shippingAddress = mysqli_fetch_array($query_shippingAddress);
$address = $result_shippingAddress['address'] .", ". $result_shippingAddress['city'] .", ". $result_shippingAddress['state'] .", ". $result_shippingAddress['zipcode'] .", ". $result_shippingAddress['country'];
$ship_id = $result_shippingAddress['ShipAdd_ID'];

//get customer billing address
$query_BillAddress = mysqli_query($con,"SELECT * FROM billing_address WHERE FK_BillAdd_Cust_ID = '$custID'");
$result_BillAddress = mysqli_fetch_array($query_BillAddress);
$bill_id = $result_BillAddress['BillAdd_ID'];

//get product detail
$productID = $_GET['product_ID'];
$query_product = mysqli_query($con,"SELECT * FROM `product` WHERE Product_ID = '$productID'");
$result_product = mysqli_fetch_array($query_product);

//Find Seller Name
$sellerID = $result_product['FK_Product_Seller_ID'];
$query_seller = mysqli_query($con,"SELECT * FROM seller where Seller_ID ='$sellerID'");
$result_seller = mysqli_fetch_array($query_seller);

?>
<div class="row mt-5 mb-5">
    <div class="col-2">
    </div>
    <div class="col-8">
        <div class="row bg-white mt-3 mb-3 p-3 shadow-sm">
            <div class="row">
                <span><i class="bi bi-geo-alt-fill"></i> Delivery Address</span>
            </div>
            <div class="row p-2 ms-3">
                <div style="font-weight: bold;" class="col-2 text-start"><?php echo $result_customerDetail['Cust_Name'] ?></div>
                <div style="font-weight: bold;" class="col-2 text-start"><?php echo $result_customerDetail['Cust_Phone'] ?></div>
                <div class="col-7">
                    <?php 
                        if($result_shippingAddress['ShipAdd_ID']==''){
                    ?>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#AddressModal"><i class="bi bi-info-square-fill"></i> Add Shipping Address</button>
                        <span style="font-size: 14px;" class="text-danger">*Please Add Shipping Address to proceed checkout</span>
                    <?php
                        }else{
                            echo $address; 
                        }
                        
                    ?>
                </div>
            </div>
        </div>
        <div class="row bg-white mt-3 pt-3 ps-3 pe-3 shadow-sm">
            <div style="font-size: 17px;" class="col-7">Products Ordered</div>
            <div style="font-size: 14px;" class="col-2"><center>Unit Price</center></div>
            <div style="font-size: 14px;" class="col-1"><center>Amount</center></div>
            <div style="font-size: 14px;" class="col-2 text-end">Item Subtotal</div> 
        </div>
        <?php
            
        ?>
            <div class="row bg-white p-3 shadow-sm"><span><?php echo $result_seller['Seller_Name']?></span></div>
            <div class="row bg-white p-3 shadow-sm">
            <!--Product List-->
                <div style="position:relative" class="col-7"><img style="height: 3rem; width:3rem;" src="../seller/<?php echo $result_product['Product_Image']; ?>">
                <?php
                    if($result_product['Product_RecordType']=='yes'){ 
                ?>
                    <div style="position:absolute; top:-20px; left:-10px;color: white; font-size:10px" class="bg-danger p-1">Prescribed medicine</div>
                <?php
                    }
                ?>
                <?php echo $result_product['Product_Name']; ?></div>
                <div class="col-2"><center>RM <?php echo $result_product['Product_SellingPrice'];?></center></div>
                <div class="col-1"><center><?php echo $_GET['quantity']; ?></center></div>
                <div class="col-2 text-end">RM <?php echo $_GET['quantity']*$result_product['Product_SellingPrice'];?></div>
            </div>
            
            <div style="background-color: rgb(235, 251, 255);" class="row p-3 shadow-sm">
            <!--Delivery option-->
            <?php
                if(isset($_POST['changeDeliveryBtn'])){

                        $change_Seller_ID = $_POST['change_seller_id'];
                        $change_shipping_id = $_POST['change_shipping_id'];

                    //Update Delivery
                    $Shipping_ID = $change_shipping_id;
                    //echo '<script>window.location.href="cust_checkout_buyNow.php?quantity='.$quantity.'&product_ID='.$product_ID.'&record_id='.$record_id.'"</script>';

                }

                $Shipping_ID;
                if(empty($Shipping_ID)){
                    $Shipping_ID = 1;
                }else{
                    $Shipping_ID;
                }

                //shipping method data
                $query_shipping_method = mysqli_query($con,"SELECT * FROM shipping WHERE Shipping_ID = '$Shipping_ID'");
                $result_shipping_method = mysqli_fetch_array($query_shipping_method);
                $shipping_price = $result_shipping_method['Shipping_Price'];
            ?>
                <div class="col-6"></div>
                <div class="col-2 text-end"><?php echo $result_shipping_method['Shipping_Method']; ?></div>
                <div class="col-2 text-end">
                    <a href="#" class="text-decoration-none text-primary" data-bs-toggle="modal" data-bs-target="#changeShipping<?php echo $sellerID; ?>">Change</a>
                </div>
                <div class="modal fade" id="changeShipping<?php echo $sellerID; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">Select Shipping Option</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post">
                        <div class="modal-body">
                            <div class="container">
                                <div class="col">
                                    <div class="row">Medicine Shopping Supported Logistics</div>
                                    <div style="font-size: 12px; color: grey;" class="row">Medicine Shopping Logistics allow you to track your order within the system web</div>
                                    <div class="row">
                                        <div class="form-check">
                                            <?php 
                                                $query_shipping = mysqli_query($con,"SELECT * FROM shipping");
                                                while($result_shipping = mysqli_fetch_array($query_shipping)){
                                                
                                                $shipping_id_radio = $result_shipping['Shipping_ID'];
                                                $shipping_method_radio = $result_shipping['Shipping_Method'];
                                                $shipping_price_radio = $result_shipping['Shipping_Price'];
                                                $shipping_day_radio = $result_shipping['shipping_day'];
                                            ?>
                                            <div class="row p-2">
                                                <div style="background-color: rgb(245, 245, 245);" class="row  border-start border-danger border-5">
                                                    <div style="height: 80px;" class="col-2">
                                                        <input class="mt-4 p-5" type="radio" name="change_shipping_id" value="<?php echo $shipping_id_radio ?>">
                                                    </div>
                                                    <div style="height: 80px;" class="col-10 p-3">
                                                        <div class="row">
                                                            <div class="col-7"><b><?php echo $shipping_method_radio; ?></b></div>
                                                            <div class="col-5"><span class="text-danger">RM<?php echo $shipping_price_radio; ?></span></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="hidden" name="change_seller_id" value="<?php echo $sellerID; ?>">
                                                                <span style="font-size: 13px;color: grey;">Received by 
                                                                    <?php 
                                                                        if($shipping_day_radio == '0'){
                                                                            echo date("d M h:i a", strtotime('+24 hours'));
                                                                        }else{
                                                                            echo date("d",strtotime('+1 day')).' - '.date("d M",strtotime("+$shipping_day_radio day"));
                                                                        }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" name="changeDeliveryBtn" class="btn btn-primary">Submit</button>
                        </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="col-2 text-end">RM <?php echo $result_shipping_method['Shipping_Price']; ?></div>
            </div>
            <div style="background-color: rgb(235, 251, 255);" class="row p-3 mb-3 shadow-sm">
            <!--Total Payment order-->
                <div class="col-9"></div>
                <div style="font-size: 14px;" class="col-2 pt-1 text-end text-black-50">Order Total (<?php echo "1"?> Item):</div>
                <div style="font-size: 20px; font-weight: bold;" class="col-1 text-end text-danger">RM<?php echo  $_GET['quantity']*$result_product['Product_SellingPrice']+$shipping_price ?></div>
            </div>

            <div class="row bg-white mt-3 mb-3 p-3 shadow-sm">
            <!-- place order and total price -->

            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">
                    <div class="row ms-5">
                        <div style="font-size: 14px; color: grey;" class="col-6 ms-3">
                            <div style="height: 40px;" class="row">Merchandise Subtotal:</div>
                            <div style="height: 40px;" class="row">Shipping Total:</div>
                            <div style="height: 50px;" class="row pt-3">Total Payment:</div>
                        </div>
                        <div class="col-5">
                            <div style="height: 40px; color: grey;" class="row"><span class="text-end">RM<?php echo $_GET['quantity']*$result_product['Product_SellingPrice'];?></span></div>
                            <div style="height: 40px; color: grey;" class="row"><span class="text-end"><?php echo $result_shipping_method['Shipping_Price']; ?></span></div>
                            <div style="height: 50px; font-size: 30px; font-weight: 500;" class="row text-danger"><span class="text-end">RM<?php echo ($_GET['quantity']*$result_product['Product_SellingPrice'])+$result_shipping_method['Shipping_Price'];?></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div class="col-9"></div>
                <div class="col-3">
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <form method="post" action="online_banking_buyNow">
                            <input type="hidden" name="product_qty" value="<?php echo $quantity; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product_ID; ?>">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            <input type="hidden" name="seller_id" value="<?php echo $sellerID; ?>">
                            <input type="hidden" name="shipping_id" value="<?php echo $result_shipping_method['Shipping_ID']; ?>">
                            <input type="hidden" name="Order_Amount" value="<?php echo ($_GET['quantity']*$result_product['Product_SellingPrice'])+$result_shipping_method['Shipping_Price']; ?>">
                            <input type="hidden" name="ShipAdd_Id" value="<?php echo $ship_id; ?>">
                            <input type="hidden" name="BillAdd_Id" value="<?php echo $bill_id; ?>">
                            <button class="btn btn-primary" name="Order_button" type="submit" <?php if($result_shippingAddress['ShipAdd_ID']==''){echo 'disabled';} ?>>Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-2"></div>
</div>
 <!-- Add Shipping -->
 <div class="modal fade" id="AddressModal" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Add Shipping Address <strong> <?php echo $result_customerDetail['Cust_Name'] ?></strong></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form method="POST">
            <div class="row mb-3 mt-4">
                <input type="text" class="form-control" name="address" placeholder="Address" required/>
            </div>
            <div class="row mb-3">
                <input type="text" class="form-control" name="city" placeholder="City" required/>
            </div>
            <div class="row mb-3">
                <input type="text" class="form-control" name="state" placeholder="State"  required/>    
            </div>
            <div class="row mb-3">
                <input type="text" class="form-control" name="zipcode" placeholder="Zipcode"  required/>    
            </div>
            <div class="row mb-3">
                <input type="text" class="form-control" name="country" placeholder="Country"  required/>    
            </div>
        <div class="modal-footer">
            <input type="hidden" value="<?php echo $custID; ?>" name="cust_ID">
            <button class="btn btn-primary" name="saveDetailShip" type="submit">Save</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </form>   
    </div>
    </div>
</div>
<!-- Add Shipping -->
<?php
    if(isset($_POST['saveDetailShip'])){
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $country = $_POST['country'];
        $shipCust_ID = $_POST['cust_ID'];

        $query_AddShip = mysqli_query($con,"INSERT INTO shipping_address(address, city, state, zipcode, country, FK_ShipAdd_Cust_ID) 
        VALUES ('$address','$city','$state','$zipcode','$country','$shipCust_ID')");

        $query_AddBill = mysqli_query($con,"INSERT INTO billing_address(address, city, state, zipcode, country, FK_BillAdd_Cust_ID) 
        VALUES ('$address','$city','$state','$zipcode','$country','$shipCust_ID')");
        echo "<script>window.location.href='cust_checkout.php'</script>";
    }
?>

<?php include("Interface/footer.php")?>