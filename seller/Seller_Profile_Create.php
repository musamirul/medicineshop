<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Interface/style/bootstrap/css/bootstrap.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="Interface/style/css/style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="Interface/style/DataTables/css/jquery.dataTables.css">
    <link href="Interface/style/summernote/summernote-lite.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="Interface/style/DataTables/dataTables.bootstrap5.min.css">-->
  </head>
  <body>

<?php
    session_start();
    include("../includes/config.php");
    if(isset($_SESSION['message'])){
        $_SESSION['message'];
        echo "<div class='alert alert-success mt-3 ms-5' role='alert' style='position : absolute; width:500px'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
        . $_SESSION['message'] .
        "</div>";

        unset($_SESSION['message']);
    }   
?>

        <div class="container-fluid">
            <div class="row m-5 shadow bg-body rounded" style="height: 800px; background-image: url('Interface/style/image/phn2.png'); background-repeat: no-repeat;background-size: cover;">
                <div class="col-3">
                </div>
                <div style="height: 90%;" class="col-6 mt-5 bg-white shadow-lg bg-body rounded-3">
                    <div class="row pt-5">
                        <div class="d-flex justify-content-center">
                            <div class="p-2 bd-highlight"><img src="Interface/style/image/logo.png" style="height: 30px;"></div>
                            <div class="pe-2 pt-2 pb-2 bd-highlight" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-weight: bold; font-size: 20px;">OnlineMedicineShopping</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                            <div class="col-6">
                            <center><h2 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Update Profile</h2></center>
                            <center><span style="color: grey; font-size: 13px;">Please Fill in detail to complete registration</span></center>
                            
                            <!--Nav bar Sign In-->
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form method="POST">
                                <div class="row mb-3 mt-4">
                                    <input type="text" class="form-control" name="username" value="<?php echo $_SESSION['username'] ?>" disabled/>
                                </div>
                                <div class="row mb-3 mt-4">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Company Name" required/>
                                </div>
                                <div class="row mb-3">
                                    <input type="number" class="form-control" name="registrationNo" placeholder="Enter Company Registration No" required/>
                                </div>
                                <div class="row mb-3">
                                    <input type="number" class="form-control" name="phone" placeholder="Enter Company Contact No" required/>
                                </div>
                                <div class="row mb-3">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="address" placeholder="Enter Company Address" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Company Address</label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <select class="form-select" name="bankName">
                                        <option selected>Select your bank account</option>
                                        <option value="maybank">Bank Islam</option>
                                        <option value="maybank">Maybank</option>
                                        <option value="cimb">CIMB</option>
                                        <option value="public">Public Bank Bhd</option>
                                        <option value="hongleong">Hong Leong</option>
                                        <option value="ambank">Ambank Group</option>
                                        <option value="uob">United Overseas Bank</option>
                                        <option value="rakyat">Bank Rakyat</option>
                                        <option value="ocbc">OCBC Bank</option>
                                        <option value="hsbc">HSBC Bank Malaysia</option>
                                        <option value="rhb">RHB</option>
                                    </select>
                                </div>
                                <div class="row mb-3">
                                    <input type="number" class="form-control" name="bankNo" placeholder="Enter Bank Account No" required/>
                                </div>
                                <div class="d-grid gap-1">
                                    <button class="btn btn-primary" name="saveDetail" type="submit">Save</button>
                                </div>
                            </form>
                        <div class="col-3"></div>
                    </div>
                </div>
                <div class="col-3">

                </div>
            </div>
        </div>
<?php
    if(isset($_POST['saveDetail'])){
        
        echo $username = $_SESSION['username'];
        echo $company = $_POST['name'];
        echo $registrationNo = $_POST['registrationNo'];
        echo $phone = $_POST['phone'];
        echo $address = $_POST['address'];
        echo $bankName = $_POST['bankName'];
        echo $bankNo = $_POST['bankNo'];

        //get seller loginID
        $query_getId = mysqli_query($con, "SELECT * FROM login WHERE username = '$username'");
        $result_getId = mysqli_fetch_array($query_getId);
        $loginID = $result_getId['Login_ID'];

        //insert into seller database
        $query_insert = mysqli_query($con,"INSERT INTO seller(Seller_Name, Seller_RegistrationNo, Seller_Phone, Seller_Address, Seller_BankAccName, Seller_BankAccNo, Seller_Registration_Status, FK_Seller_Login_ID)
        VALUES ('$company','$registrationNo','$phone','$address','$bankName','$bankNo','reqApproval','$loginID')");

        //Select seller id
        $query_selectSellerID = mysqli_query($con,"SELECT * FROM seller WHERE FK_Seller_Login_ID='$loginID'");
        $result_selectSellerID = mysqli_fetch_array($query_selectSellerID);
        $seller_id = $result_selectSellerID['Seller_ID'];

        //Create Shop Profile
        $query_createShop = mysqli_query($con,"INSERT INTO seller_shop(Shop_Desc, Shop_Img, Shop_Img_File, Shop_Cover, Shop_Cover_File, FK_Shop_Seller_ID) 
        VALUES ('','','','','','$seller_id')");



        //Create Wallet
        $amount = 0;
        $query_wallet = mysqli_query($con,"INSERT INTO wallet(Wallet_Amount, FK_Wallet_Seller_ID) VALUES ('$amount','$seller_id')");

        $_SESSION['message'] = "yours account have successfully created, waiting for administrator for approval";
        unset($_SESSION['username']);
        echo '<script>window.location.href="../Login.php"</script>';
    }
?>
<?php include("Interface/footer.php"); ?>




