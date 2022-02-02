<?php include("Interface/header.php"); ?>
<?php
    $SellerID = $_SESSION['Seller_Id'];
    $query_seller = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID = '$SellerID'");
    $result_seller = mysqli_fetch_array($query_seller);
?>
<?php include("Message_Notification.php")?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-info-square"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">My Information</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and update your information</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Company Name </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo $result_seller['Seller_Name'] ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Registration Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="regNo" placeholder="Please Enter your fullname" value="<?php echo $result_seller['Seller_RegistrationNo'] ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Contact Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" placeholder="Please Enter your contact No" value="<?php echo $result_seller['Seller_Phone'] ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Company Address</label>
                <div class="col-sm-10">
                    <textarea id="summernote_spec" class="form-control" rows="5" cols="50" name="address" placeholder="Enter Company Address"><?php echo $result_seller['Seller_Address'] ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Bank Account</label>
                <div class="col-sm-10">
                    <select class="form-select" name="bankName">
                        <option value="cimb" <?php if($result_seller['Seller_BankAccName']=='cimb'){echo 'selected';}; ?>>CIMB</option>
                        <option value="maybank" <?php if($result_seller['Seller_BankAccName']=='maybank'){echo 'selected';}; ?>>MAYBANK</option>
                        <option value="rhb" <?php if($result_seller['Seller_BankAccName']=='rhb'){echo 'selected';}; ?>>RHB</option>
                        <option value="public" <?php if($result_seller['Seller_BankAccName']=='public'){echo 'selected';}; ?>>Public Bank</option>
                        <option value="hongleong" <?php if($result_seller['Seller_BankAccName']=='hongleong'){echo 'selected';}; ?>>Hong Leong Bank</option>
                        <option value="ambank" <?php if($result_seller['Seller_BankAccName']=='amBank'){echo 'selected';}; ?>>Ambank Group</option>
                        <option value="uob" <?php if($result_seller['Seller_BankAccName']=='uob'){echo 'selected';}; ?>>UOB Malaysia</option>
                        <option value="bankrakyat" <?php if($result_seller['Seller_BankAccName']=='bankrakyat'){echo 'selected';}; ?>>Bank Rakyat</option>
                        <option value="ocbc" <?php if($result_seller['Seller_BankAccName']=='ocbc'){echo 'selected';}; ?>>OCBC Bank</option>
                        <option value="hsbc" <?php if($result_seller['Seller_BankAccName']=='hsbc'){echo 'selected';}; ?>>HSBC Bank</option>
                      </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Bank Account Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="bankNo" placeholder="Please Enter your account no" value="<?php echo $result_seller['Seller_BankAccNo'] ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-2"></div>
                <div class="col-sm-10">
                    <button type="submit" name="updateInfoBtn" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['updateInfoBtn'])){
        $name = $_POST['name'];
        $regNo = $_POST['regNo'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $bankName = $_POST['bankName'];
        $bankNo = $_POST['bankNo'];

        $query_updateSeller = mysqli_query($con,"UPDATE seller SET Seller_Name='$name',Seller_RegistrationNo='$regNo',Seller_Phone='$phone',
        Seller_Address='$address',Seller_BankAccName='$bankName',Seller_BankAccNo='$bankNo' WHERE Seller_ID = '$SellerID'");
        $_SESSION['message'] = 'Successfully update information';
        echo '<script>window.location.href="Seller_Information.php?msg=success"</script>';

    }
?>
<?php include("Interface/footer.php"); ?>