<?php include("Interface/header.php"); ?>
<?php
    $AdminID = $_SESSION['Admin_Id'];
    $query_admin = mysqli_query($con,"SELECT * FROM administrator WHERE Admin_ID = '$AdminID'");
    $result_admin = mysqli_fetch_array($query_admin);
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
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Name </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?php echo $result_admin['Admin_Name'] ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" placeholder="Please Enter your Email" value="<?php echo $result_admin['Admin_Email'] ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Employee Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="empNo" placeholder="Please Enter your Employee Number" value="<?php echo $result_admin['Admin_EmpNo'] ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Department</label>
                <div class="col-sm-10">
                      <select class="form-select" class="form-select form-select-sm" name="department">
                        <option value="administration" <?php if($result_admin['Admin_Dept']=='administrator'){echo 'selected';}; ?>>Administration</option>
                        <option value="it" <?php if($result_admin['Admin_Dept']=='it'){echo 'selected';}; ?>>Information Technology</option>                           
                        <option value="finance" <?php if($result_admin['Admin_Dept']=='finance'){echo 'selected';}; ?>>Finance</option>                           
                        <option value="purchasing" <?php if($result_admin['Admin_Dept']=='purchasing'){echo 'selected';}; ?>>purchasing</option>                           
                        <option value="marketing" <?php if($result_admin['Admin_Dept']=='marketing'){echo 'selected';}; ?>>marketing</option>                           
                        <option value="consultant" <?php if($result_admin['Admin_Dept']=='consultant'){echo 'selected';}; ?>>consultant</option>                           
                        <option value="pharmacist" <?php if($result_admin['Admin_Dept']=='pharmacist'){echo 'selected';}; ?>>pharmacist</option>                           
                    </select>
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
        $email = $_POST['email'];
        $empNo = $_POST['empNo'];
        $department = $_POST['department'];

        $query_updateSeller = mysqli_query($con,"UPDATE administrator SET Admin_Name='$name',Admin_Email='$email',Admin_EmpNo='$empNo',Admin_Dept='$department' 
        WHERE Admin_ID = '$AdminID'");
        
        $_SESSION['message'] = 'Successfully update information';
        echo '<script>window.location.href="Admin_Information.php?msg=success"</script>';

    }
?>
<?php include("Interface/footer.php"); ?>