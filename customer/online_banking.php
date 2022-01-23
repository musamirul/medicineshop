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

    //ORDER ID
    $id = intval($_GET['orderId']);
    $Totalpayment=0;
    $query_order = mysqli_query($con,"SELECT * FROM orders WHERE Order_No='$id'");
    while($result_order = mysqli_fetch_array($query_order)){
        $Totalpayment = $Totalpayment+$result_order['Order_Amount'];
    }
?>

<div class="row mb-5">
    <div class="col-2"></div>
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
                        <div class="col text-end text-danger fw-bold">RM<?php echo $Totalpayment ?></div>
                    </div>
                    <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                    <div class="row">
                        <div class="col text-start">Payment Method</div>
                        <div class="col text-end">Online Banking</div>
                    </div>
                    <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                    <div class="row mb-5">
                    <form method="post">
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
    $todayDate = date('d-m-Y');
    $todayTime = date('h:i:s a');
    $ReferenceNo = rand(10,100);
    $custID = $_SESSION['Cust_Id'];
    $Order_Cart_ID;
    //Add payment to billing table
    $query_billing = mysqli_query($con,"INSERT INTO billing(Billing_Date, Billing_Time, Billing_PaymentStatus, Billing_PaymentMethod, Billing_ReferenceNo, FK_Billing_Cust_ID, FK_Billing_Order_ID) 
    VALUES ('$todayDate','$todayTime','completed','Online Banking','$ReferenceNo','$custID','$id')");

    //update orders table status = payment_completed
    $query_order = mysqli_query($con,"UPDATE orders SET Order_Status='payment_completed' WHERE Order_No = '$id'");

    //Insert data to tracking table
    $query_order_data = mysqli_query($con,"SELECT * FROM orders WHERE Order_No = '$id'");
    while($result_order_data = mysqli_fetch_array($query_order_data)){
        $Order_Cart_ID = $result_order_data['FK_Order_Cart_ID'];
        $Order_ID = $result_order_data['Order_ID'];
        $Order_Seller_ID = $result_order_data['FK_Order_Seller_ID'];
        $Order_Ship_ID = $result_order_data['FK_Order_Ship_ID'];

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

        //Insert data to tracking table
        $query_tracking = mysqli_query($con,"INSERT INTO tracking(Tracking_Date, Tracking_Time, Tracking_Status, Tracking_EstimateDate, Tracking_EstimateTime, FK_Tracking_Order_ID, FK_Tracking_Ship_ID, FK_Tracking_Cust_ID, FK_Tracking_Seller_ID) 
        VALUES ('$todayDate','$todayTime','preparing','$estDate','$estTime','$Order_ID','$Order_Ship_ID','$custID','$Order_Seller_ID')");
    }

    //update cart status = payment completed
    $query_cart = mysqli_query($con, "UPDATE cart SET Cart_Status='payment_completed' WHERE Cart_ID = '$Order_Cart_ID'");

    $_SESSION['message'] = "yours payment have been completed, we have notified the seller to ship out your order";
    echo '<script>window.location.href="cust_payment_success.php"</script>';
    
}

?>

<?php include("Interface/footer.php")?>