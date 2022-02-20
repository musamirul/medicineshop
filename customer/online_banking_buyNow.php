<?php include("Interface/header.php")?>
<?php
    $quantity = $_POST['product_qty'];
    $product_id = $_POST['product_id'];
    $record_id = $_POST['record_id'];
    $seller_id = $_POST['seller_id'];
    $shipping_id = $_POST['shipping_id'];
    $order_amount = $_POST['Order_Amount'];
    $ship_id = $_POST['ShipAdd_Id'];
    $bill_id = $_POST['BillAdd_Id'];
    $cust_ID = $_SESSION['Cust_Id'];

    

?>

<div class="row mb-5 mt-5">
    <div class="col-2">
    </div>
    <div class="col-8">
        <div class="row bg-white mt-3 mb-3 p-3 shadow-sm">
            <div class="row pt-2 pb-2">
                <span class="text-start fs-4">Online Banking</span>
            </div>
            <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            <div class="row pt-1">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="row">
                        <div class="col text-start">Total Payment</div>
                        <div class="col text-end text-danger fw-bold">RM<?php echo $order_amount; ?></div>
                    </div>
                    <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                    <div class="row">
                        <div class="col text-start">Payment Method</div>
                        <div class="col text-end">Online Banking</div>
                    </div>
                    <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                    <div class="row mb-5">
                    <form method="post">
                            <input type="hidden" name="product_qty" value="<?php echo $quantity; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            <input type="hidden" name="seller_id" value="<?php echo $seller_id; ?>">
                            <input type="hidden" name="shipping_id" value="<?php echo $shipping_id ?>">
                            <input type="hidden" name="Order_Amount" value="<?php echo $order_amount ?>">
                            <input type="hidden" name="ShipAdd_Id" value="<?php echo $ship_id; ?>">
                            <input type="hidden" name="BillAdd_Id" value="<?php echo $bill_id; ?>">
                        <button type="submit" name="payBtn" class="btn btn-primary mt-3">Pay</button>
                    </form>
                    </div>
                    <div class="row mb-5"></div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>

<?php
if(isset($_POST['payBtn'])){
    $quantity = $_POST['product_qty'];
    $product_id = $_POST['product_id'];
    $record_id = $_POST['record_id'];
    $seller_id = $_POST['seller_id'];
    $shipping_id = $_POST['shipping_id'];
    $order_amount = $_POST['Order_Amount'];
    $ship_id = $_POST['ShipAdd_Id'];
    $bill_id = $_POST['BillAdd_Id'];

    //get product detail
    $query_product = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$product_id'");
    $result_product = mysqli_fetch_array($query_product);
    $product_price = $result_product['Product_SellingPrice'];
    
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $timeStamp = date("Y-m-d h:i:sa");

    //Add to cart status pending_buyNow
    $cart_create_query = mysqli_query($con,"INSERT INTO cart(Cart_TimeStamp, Cart_Status, FK_Cart_Cust_ID)
                VALUES ('$timeStamp','pending_buyNow','$cust_ID')");

    //check newly created cart and get cart ID
    $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending_buyNow'");
    $cart_check_result = mysqli_fetch_array($cart_check_query);
    $cart_ID = $cart_check_result['Cart_ID'];

    //add item into cart_item
    $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID, FK_Item_Shipping_ID, FK_Item_Record_ID) 
    VALUES ('$quantity','$product_price','$cart_ID','$product_id','$seller_id','$shipping_id','$record_id')");
    
    
    //Add to order
    //Create Order Number
    $query_OrderNum = mysqli_query($con,"SELECT * FROM orders ORDER BY Order_ID DESC LIMIT 1 ");
    $result_OrderNum = mysqli_fetch_array($query_OrderNum);
    $Order_Number = $result_OrderNum['Order_No']+1;


    $query_Order_Add = mysqli_query($con,"INSERT INTO orders(Order_No, Order_Status, Order_Amount, FK_Order_ShipAdd_ID, FK_Order_BillAdd_ID, FK_Order_Cust_ID, FK_Order_Seller_ID, FK_Order_Cart_ID, FK_Order_Ship_ID) 
    VALUES ('$Order_Number','payment_completed','$order_amount','$ship_id','$bill_id','$cust_ID','$seller_id','$cart_ID','$shipping_id')");
        
    //change status of pending_buyNow to payment_completed
    $query_updateCart = mysqli_query($con,"UPDATE cart SET Cart_Status='payment_completed' WHERE Cart_ID = '$cart_ID'");

    //get order data
    $query_OrderGet = mysqli_query($con,"SELECT * FROM orders WHERE Order_No = '$Order_Number'");
    $result_OrderGet = mysqli_fetch_array($query_OrderGet);
    $id = $result_OrderGet['Order_ID'];

    $todayDate = date('d-m-Y');
    $todayTime = date('h:i:s a');
    $ReferenceNo = rand(10,100000000);
    //Add payment to billing table
    $query_billing = mysqli_query($con,"INSERT INTO billing(Billing_Date, Billing_Time, Billing_PaymentStatus, Billing_PaymentMethod, Billing_ReferenceNo, FK_Billing_Cust_ID, FK_Billing_Order_ID) 
    VALUES ('$todayDate','$todayTime','completed','Online Banking','$ReferenceNo','$cust_ID','$id')");

    //update orders table status = payment_completed
    $query_order = mysqli_query($con,"UPDATE orders SET Order_Status='payment_completed' WHERE Order_ID = '$id'");

    //Insert data to tracking table
    $query_order_data = mysqli_query($con,"SELECT * FROM orders WHERE Order_ID = '$id'");
    $result_order_data = mysqli_fetch_array($query_order_data);

    $Order_Cart_ID = $result_order_data['FK_Order_Cart_ID'];
    $Order_ID = $result_order_data['Order_ID'];
    $Order_Seller_ID = $result_order_data['FK_Order_Seller_ID'];
    $Order_Ship_ID = $result_order_data['FK_Order_Ship_ID'];
    $Order_Amount = $result_order_data['Order_Amount'];

        //get data from shipping table
        $query_shipping = mysqli_query($con,"SELECT * FROM shipping WHERE Shipping_ID='$Order_Ship_ID' ");
        $result_shipping = mysqli_fetch_array($query_shipping);

        $estDate;
        $estTime;
        $ship_day = $result_shipping['shipping_day'];
        if($ship_day == '0'){
            $estDate = date("d-m-Y", strtotime('+24 hours'));
            $estTime = date("h:i:s a", strtotime('+24 hours'));
        }else{
            $estDate = date("d-m-Y",strtotime("+$ship_day day"));
            $estTime = $todayTime;
        }

        //Get Wallet ID & Update Wallet
        $query_GetWalletID = mysqli_query($con,"SELECT * FROM wallet WHERE FK_Wallet_Seller_ID = '$Order_Seller_ID'");
        $result_GetWalletID = mysqli_fetch_array($query_GetWalletID);
        $wallet_ID = $result_GetWalletID['Wallet_ID'];
        //Update Wallet Amount
        $total_wallet = $result_GetWalletID['Wallet_Amount']+$Order_Amount;
        $query_updateWallet = mysqli_query($con,"UPDATE wallet SET Wallet_Amount='$total_wallet' WHERE FK_Wallet_Seller_ID = '$Order_Seller_ID'");

        //Add transaction
        $query_trans = mysqli_query($con,"INSERT INTO transaction(Transaction_Date, Transaction_Time, Transaction_Type, Transaction_Amount, Transaction_Status, FK_Transaction_Wallet_ID, FK_Transaction_Seller_ID, FK_Transaction_Order_ID) 
        VALUES ('$todayDate','$todayTime','income','$Order_Amount','completed','$wallet_ID','$Order_Seller_ID','$Order_ID')");

        //Insert data to tracking table
        $query_tracking = mysqli_query($con,"INSERT INTO tracking(Tracking_Date, Tracking_Time, Tracking_Status, Tracking_Channel, Tracking_EstimateDate, Tracking_EstimateTime, FK_Tracking_Order_ID, FK_Tracking_Ship_ID, FK_Tracking_Cust_ID, FK_Tracking_Seller_ID, FK_Tracking_Cart_ID) 
        VALUES ('$todayDate','$todayTime','preparing','','$estDate','$estTime','$Order_ID','$Order_Ship_ID','$cust_ID','$Order_Seller_ID','$Order_Cart_ID')");
    

    //update cart status = payment completed
    $query_cart = mysqli_query($con, "UPDATE cart SET Cart_Status='payment_completed' WHERE Cart_ID = '$Order_Cart_ID'");

    $_SESSION['message'] = "yours payment have been completed, we have notified the seller to ship out your order";
    echo '<script>window.location.href="cust_payment_success.php"</script>';
    
}

?>

<?php include("Interface/footer.php")?>