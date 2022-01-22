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
?>

<?php
//get customer name and phone number
$custID = $_SESSION['Cust_Id'];
$query_customerDetail = mysqli_query($con, "SELECT * FROM customer WHERE Cust_ID = '$custID'");
$result_customerDetail = mysqli_fetch_array($query_customerDetail);

//get customer delivery address
$query_shippingAddress = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID = '$custID'");
$result_shippingAddress = mysqli_fetch_array($query_shippingAddress);
$address = $result_shippingAddress['address'] .", ". $result_shippingAddress['city'] .", ". $result_shippingAddress['state'] .", ". $result_shippingAddress['zipcode'] .", ". $result_shippingAddress['country'];

//Find cart_id in cart = pending
$Cart_Cust_ID = $_SESSION['Cust_Id'];
$query_cart_CartID = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$Cart_Cust_ID' AND Cart_Status ='pending'");
$query_cart_CartID_result = mysqli_fetch_array($query_cart_CartID);
$Cart_ID = $query_cart_CartID_result['Cart_ID'];


$tempSize = 0;
$FK_Seller_ID = array();
$temp_CartID = "";
$TotalShippingID = array();
//loop div based on FK_ITEM_Seller_ID on cart_item
$query_cart_item = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Cart_ID'");
while($result_cart_item = mysqli_fetch_array($query_cart_item)){

    if($result_cart_item['FK_Item_Seller_ID'] != $temp_CartID){
        $temp_CartID = $result_cart_item['FK_Item_Seller_ID'];
        $FK_Seller_ID[] = $result_cart_item['FK_Item_Seller_ID'];
        $TotalShippingID[] = $result_cart_item['FK_Item_Shipping_ID'];
        $tempSize++;
    }
}
$tempSize;
$temp_CartID;

?>

<div class="row mb-5">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row bg-white mt-3 mb-3 p-3 shadow-sm">
            <div class="row">
                <span><i class="bi bi-geo-alt-fill"></i> Delivery Address</span>
            </div>
            <div class="row p-2 ms-3">
                <div style="font-weight: bold;" class="col-2 text-start"><?php echo $result_customerDetail['Cust_Name'] ?></div>
                <div style="font-weight: bold;" class="col-2 text-start"><?php echo $result_customerDetail['Cust_Phone'] ?></div>
                <div class="col-7"><?php echo $address; ?></div>
            </div>
        </div>
        <div class="row bg-white mt-3 pt-3 ps-3 pe-3 shadow-sm">
            <div style="font-size: 17px;" class="col-7">Products Ordered</div>
            <div style="font-size: 14px;" class="col-2"><center>Unit Price</center></div>
            <div style="font-size: 14px;" class="col-1"><center>Amount</center></div>
            <div style="font-size: 14px;" class="col-2 text-end">Item Subtotal</div> 
        </div>
        <?php
            $TotalShipping = array();
            $TotalPrice = array();
            $TotalShippingAndPrice = array();
            $count = 0;
            while($count < $tempSize) {

            //Find Seller Name
            $sellerID = $FK_Seller_ID[$count];
            $query_seller = mysqli_query($con,"SELECT * FROM seller where Seller_ID ='$sellerID'");
            $result_seller = mysqli_fetch_array($query_seller);

        ?>
            <div class="row bg-white p-3 shadow-sm"><span><?php echo $result_seller['Seller_Name']?></span></div>
            <?php
                //Find cart_item data
                $query_cart_item_select = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Item_Seller_ID = '$sellerID'");
                while($result_cart_item_select = mysqli_fetch_array($query_cart_item_select)){
                $product_ID = $result_cart_item_select['FK_Item_Product_ID'];
                
                //Find product name
                $query_product_name = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$product_ID'");
                $result_product_name = mysqli_fetch_array($query_product_name);
            ?>
                <div class="row bg-white p-3 shadow-sm">
                <!--Product List-->
                    <div class="col-7"><img style="height: 3rem; width:3rem;" src="../seller/<?php echo $result_product_name['Product_Image']; ?>">
                    <?php echo $result_product_name['Product_Name']; ?></div>
                    <div class="col-2"><center>RM <?php echo $result_cart_item_select['Cart_Item_Amount'];?></center></div>
                    <div class="col-1"><center><?php echo $result_cart_item_select['Cart_Item_Qty'] ?></center></div>
                    <div class="col-2 text-end">RM <?php echo $result_cart_item_select['Cart_Item_Amount']*$result_cart_item_select['Cart_Item_Qty'];?></div>
                </div>
            <?php
                }
            ?>
            <div style="background-color: rgb(235, 251, 255);" class="row p-3 shadow-sm">
            <!--Delivery option-->
            <?php
                /*
                    1) get shipping id from cart_item
                    2) get data from shipping table
                */
                $query_shipping_id = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Item_Seller_ID = '$sellerID'");
                $result_shipping_id = mysqli_fetch_array($query_shipping_id);
                $Shipping_ID = $result_shipping_id['FK_Item_Shipping_ID'];

                //shipping method data
                $query_shipping_method = mysqli_query($con,"SELECT * FROM shipping WHERE Shipping_ID = '$Shipping_ID'");
                $result_shipping_method = mysqli_fetch_array($query_shipping_method);
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
            <?php
                
                //Subtotal & subAmount
                $total_quantity = 0;
                $total_amount = 0;

                $query_total = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Cart_ID' AND FK_Item_Seller_ID = '$sellerID'");
                while($result_total = mysqli_fetch_array($query_total)){
                    $total_quantity = $total_quantity+$result_total['Cart_Item_Qty'];
                    $total_amount = $total_amount+($result_total['Cart_Item_Qty']*$result_total['Cart_Item_Amount']);
                }
            ?>
                <div class="col-9"></div>
                <div style="font-size: 14px;" class="col-2 pt-1 text-end text-black-50">Order Total (<?php echo $total_quantity?> Item):</div>
                <div style="font-size: 20px; font-weight: bold;" class="col-1 text-end text-danger">RM<?php echo $total_amount+$result_shipping_method['Shipping_Price'] ?></div>
                <?php 
                    //push total amount and quantity to array()
                    $TotalPrice[] = $total_amount;
                    $TotalShipping[] = $result_shipping_method['Shipping_Price'];
                    $TotalShippingAndPrice[] = $total_amount + $result_shipping_method['Shipping_Price'];

                ?>
            </div>
        <?php
            $count++;
            } 
        ?>

        <div class="row bg-white mt-3 mb-3 p-3 shadow-sm">
            <!-- place order and total price -->
            <?php 
                $TotalShipping_count = 0;
                $TotalPrice_count = 0;

                for($x=0 ; $x<count($TotalShipping); $x++){
                    $TotalShipping_count = $TotalShipping_count + $TotalShipping[$x];
                }
                for($y=0 ; $y<count($TotalPrice); $y++){
                    $TotalPrice_count = $TotalPrice_count + $TotalPrice[$y];
                }
            ?>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">
                    <div class="row ms-5">
                        <div style="font-size: 14px; color: grey;" class="col-6 ms-3">
                            <div style="height: 40px;" class="row">Merchandise Subtotal:</div>
                            <div style="height: 40px;" class="row">Shippint Total:</div>
                            <div style="height: 50px;" class="row pt-3">Total Payment:</div>
                        </div>
                        <div class="col-5">
                            <div style="height: 40px; color: grey;" class="row"><span class="text-end">RM<?php echo $TotalPrice_count; ?></span></div>
                            <div style="height: 40px; color: grey;" class="row"><span class="text-end"><?php echo $TotalShipping_count; ?></span></div>
                            <div style="height: 50px; font-size: 30px; font-weight: 500;" class="row text-danger"><span class="text-end">RM<?php echo $TotalShipping_count+$TotalPrice_count; ?></span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-3">
                <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div class="col-9"></div>
                <div class="col-3">
                    <div class="d-grid gap-2 col-12 mx-auto">
                        <form method="post">
                            <input type="hidden" name="Order_Amount" value="<?php echo htmlspecialchars(serialize($TotalShippingAndPrice)); ?>">
                            <input type="hidden" name="FK_Order_Seller_ID" value="<?php echo htmlspecialchars(serialize($FK_Seller_ID)); ?>">
                            <button class="btn btn-primary" name="Order_button" type="submit">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-2"></div>
</div>
<?php
    if(isset($_POST['Order_button'])){
        $ArrayTotalShippingAndPrice = unserialize($_POST['Order_Amount']);
        $ArrayFK_Seller_ID = unserialize($_POST['FK_Order_Seller_ID']);
        $Order_Cust_ID = $_SESSION['Cust_Id'];
        //Find Cust ShipAddress
        $query_shipadd = mysqli_query($con,"SELECT ShipAdd_ID FROM shipping_address WHERE FK_ShipAdd_Cust_ID = '$Order_Cust_ID'");
        $result_shipadd = mysqli_fetch_array($query_shipadd);
        $ShipAdd_ID =  $result_shipadd['ShipAdd_ID'];

        //FInd Cust BillAddress
        $query_billadd = mysqli_query($con,"SELECT BillAdd_ID FROM billing_address WHERE FK_BillAdd_Cust_ID = '$Order_Cust_ID'");
        $result_billadd = mysqli_fetch_array($query_billadd);
        $BillAdd_ID =  $result_billadd['BillAdd_ID'];

        //Create Order Number
        $query_OrderNum = mysqli_query($con,"SELECT Order_No FROM orders ORDER BY Order_ID LIMIT 1");
        $result_OrderNum = mysqli_fetch_array($query_OrderNum);
        $Order_Number = $result_OrderNum['Order_No']+1;

        $z = 0;
        while($z<count($ArrayFK_Seller_ID)){
            $ArrayFK_Seller_ID[$z];
            $ArrayTotalShippingAndPrice[$z];
            $TotalShippingID[$z];


            $queery_Order_Add = mysqli_query($con,"INSERT INTO orders(Order_No, Order_Status, Order_Amount, FK_Order_ShipAdd_ID, FK_Order_BillAdd_ID, FK_Order_Cust_ID, FK_Order_Seller_ID, FK_Order_Cart_ID, FK_Order_Ship_ID) 
            VALUES ('$Order_Number','payment_pending','$ArrayTotalShippingAndPrice[$z]','$ShipAdd_ID','$BillAdd_ID','$Order_Cust_ID','$ArrayFK_Seller_ID[$z]','$Cart_ID','$TotalShippingID[$z]')");
            
            $z++;
        }

        //change cart status
        echo "<script>window.location.href='online_banking.php?orderId=$Order_Number'</script>";

    }
?>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<?php
    if(isset($_POST['changeDeliveryBtn'])){
            $change_Cart_ID = $Cart_ID;
            $change_Seller_ID = $_POST['change_seller_id'];

            $change_shipping_id = $_POST['change_shipping_id'];

        //Update Delivery
        $query_updateDelivery = mysqli_query($con,"UPDATE cart_item SET FK_Item_Shipping_ID='$change_shipping_id' WHERE FK_Cart_ID = '$change_Cart_ID' AND FK_Item_Seller_ID = '$change_Seller_ID'");        
        echo '<script>window.location.href="cust_checkout.php"</script>';
    }
?>


<?php include("Interface/footer.php")?>