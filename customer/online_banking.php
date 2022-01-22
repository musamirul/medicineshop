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
    $query_billing = mysqli_query($con,"INSERT INTO billing(Billing_Date, Billing_Time, Billing_PaymentStatus, Billing_PaymentMethod, Billing_ReferenceNo, FK_Billing_Cust_ID, FK_Billing_Order_ID) 
    VALUES ('$todayDate','$todayTime','completed','Online Banking','$ReferenceNo','$custID','$id')");
}

?>

<?php include("Interface/footer.php")?>