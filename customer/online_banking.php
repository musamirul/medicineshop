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

    $Totalpayment = $_POST['Totalpayment'];
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
                        <button class="btn btn-primary mt-3">Pay</button>
                    </div>
                    <div class="row mb-5"></div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
    <div class="col-2"></div>
</div>

<?php include("Interface/footer.php")?>