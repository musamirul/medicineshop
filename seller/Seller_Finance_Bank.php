<?php include("Interface/header.php"); ?>
<?php 
    $Seller_ID = $_SESSION['Seller_Id'];
    $query_seller = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID = '$Seller_ID'");
    $result_seller = mysqli_fetch_array($query_seller);

?>
<?php include("Message_Notification.php")?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-bank"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Bank Account</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and update your Bank Account</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <div class="col-3"></div>
            <div class="col-6">
            <form method="post">
                <div class="row mb-3">
                    <label style="font-size: 14px; color: grey;" class="col-sm-3 col-form-label">Bank Name</label>
                    <div class="col-sm-9">
                        <select class="form-select" name="bank_Name">
                            <option value="maybank" <?php if($result_seller['Seller_BankAccName']=='islam')echo 'selected' ?>>Bank Islam</option>
                            <option value="maybank" <?php if($result_seller['Seller_BankAccName']=='maybank')echo 'selected' ?>>Maybank</option>
                            <option value="cimb" <?php if($result_seller['Seller_BankAccName']=='cimb')echo 'selected' ?>>CIMB</option>
                            <option value="public" <?php if($result_seller['Seller_BankAccName']=='public')echo 'selected' ?>>Public Bank Bhd</option>
                            <option value="hongleong" <?php if($result_seller['Seller_BankAccName']=='hongleong')echo 'selected' ?>>Hong Leong</option>
                            <option value="ambank" <?php if($result_seller['Seller_BankAccName']=='ambank')echo 'selected' ?>>Ambank Group</option>
                            <option value="uob" <?php if($result_seller['Seller_BankAccName']=='uob')echo 'selected' ?>>United Overseas Bank</option>
                            <option value="rakyat" <?php if($result_seller['Seller_BankAccName']=='rakyat')echo 'selected' ?>>Bank Rakyat</option>
                            <option value="ocbc" <?php if($result_seller['Seller_BankAccName']=='ocbc')echo 'selected' ?>>OCBC Bank</option>
                            <option value="hsbc" <?php if($result_seller['Seller_BankAccName']=='hsbc')echo 'selected' ?>>HSBC Bank Malaysia</option>
                            <option value="rhb" <?php if($result_seller['Seller_BankAccName']=='rhb')echo 'selected' ?>>RHB</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label style="font-size: 14px; color: grey;" class="col-sm-3 col-form-label">Bank Account</label>
                    <div class="col-sm-9">
                    <input type="text" name="bank_Account" class="form-control" value="<?php echo $result_seller['Seller_BankAccNo'] ?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="updateBankBtn" class="btn btn-primary float-end">Save</button>
                    </div>
                </div>
            </form>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['updateBankBtn'])){
        $bankName = $_POST['bank_Name'];
        $bankAcc = $_POST['bank_Account'];

        $query_updateBank = mysqli_query($con,"UPDATE seller SET Seller_BankAccName='$bankName',Seller_BankAccNo='$bankAcc' WHERE Seller_ID = '$Seller_ID'");
        $_SESSION['message'] = 'Successfully update bank account';
        echo '<script>window.location.href="Seller_Finance_Bank.php?msg=success"</script>';
    }
?>

<?php include("Interface/footer.php"); ?>