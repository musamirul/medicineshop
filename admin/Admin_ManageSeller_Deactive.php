<?php include("Interface/header.php"); ?>
<?php 
    //Count All
    $query_countall = mysqli_query($con,"SELECT count(*) FROM seller");
    $result_countall = mysqli_fetch_array($query_countall);
    $allcount = $result_countall[0];

    //Count active
    $query_countactive = mysqli_query($con,"SELECT count(*) FROM seller WHERE Seller_Registration_Status = 'Active'");
    $result_countactive = mysqli_fetch_array($query_countactive);
    $activecount = $result_countactive[0];

    //Count reqApproval
    $query_countreq = mysqli_query($con,"SELECT count(*) FROM seller WHERE Seller_Registration_Status = 'reqApproval'");
    $result_countreq = mysqli_fetch_array($query_countreq);
    $reqcount = $result_countreq[0];

    //count deactive
    $query_countdeactive = mysqli_query($con,"SELECT count(*) FROM seller WHERE Seller_Registration_Status = 'deactive'");
    $result_countdeactive = mysqli_fetch_array($query_countdeactive);
    $deactivecount = $result_countdeactive[0];

    //count suspend
    $query_countsuspend = mysqli_query($con,"SELECT count(*) FROM seller WHERE Seller_Registration_Status = 'suspend'");
    $result_countsuspend = mysqli_fetch_array($query_countsuspend);
    $suspendcount = $result_countsuspend[0];

?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-person-fill"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Seller Management</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and manage seller</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <!-- Purchase table -->
            <div class="col">
                <div class="row bg-white p-3">
                    <ul class="nav nav-pills d-flex justify-content-start">
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_ManageSeller.php"><center>All<span class="shadow badge bg-secondary ms-3"><?php echo $allcount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_ManageSeller_Active.php"><center>Active<span class="shadow badge bg-secondary ms-3"><?php echo $activecount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link <?php if($reqcount>0){echo 'bg-danger';}else{echo 'text-reset';} ?>" href="Admin_ManageSeller_ReqApproval.php"><center><span class="<?php if($reqcount>0)echo 'text-white' ?>">Req. Approval</span><span class="shadow badge bg-secondary ms-3"><?php echo $reqcount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link active" href="Admin_ManageSeller_Deactive.php"><center>Deactive<span class="shadow badge bg-secondary ms-3"><?php echo $deactivecount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_ManageSeller_Suspend.php"><center>Suspend<span class="shadow badge bg-secondary ms-3"><?php echo $suspendcount ?></span></center></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <table id="example" class="display center" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Seller ID</th>
                        <th>Seller Name</th>
                        <th>Reg No</th>
                        <th>Phone No</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //display all table data
                        $query_showData = mysqli_query($con,"SELECT * FROM seller WHERE Seller_Registration_Status='deactive'");
                        while($result_showData = mysqli_fetch_array($query_showData)){
                        $Seller_ID = $result_showData['Seller_ID'] 
                    ?>
                    <tr>
                        <td><?php echo $result_showData['Seller_ID']; ?></td>
                        <td><?php echo $result_showData['Seller_Name']; ?></td>
                        <td><?php echo $result_showData['Seller_RegistrationNo']; ?></td>
                        <td><?php echo $result_showData['Seller_Phone']; ?></td>
                        <td><?php echo $result_showData['Seller_Address']; ?></td>
                        <form method="post">
                        <td>
                            <select class="form-select form-select-sm mb-3" name="status">
                                <option value="Active" <?php if($result_showData['Seller_Registration_Status']=='Active'){echo 'selected';} ?>>Active</option>
                                <option value="deactive" <?php if($result_showData['Seller_Registration_Status']=='deactive'){echo 'selected';}  ?>>Deactive</option>
                                <option value="suspend" <?php if($result_showData['Seller_Registration_Status']=='suspend'){echo 'selected';}  ?>>Suspend</option>
                                <option value="reqApproval" <?php if($result_showData['Seller_Registration_Status']=='reqApproval'){echo 'selected';}  ?>>ReqApproval</option>
                            </select>
                        <td>
                            <input type="hidden" value="<?php echo $result_showData['Seller_ID']; ?>" name="seller_ID">
                            <button type="submit" name="saveDetail" class="btn btn-primary">Update</button>
                        </td>
                        </form>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['saveDetail'])){
        $hseller_id = $_POST['seller_ID'];
        $status = $_POST['status'];

        $query_updateSeller = mysqli_query($con,"UPDATE seller SET Seller_Registration_Status='$status' WHERE Seller_ID = '$hseller_id'");
        
        echo '<script>window.location.href="Admin_ManageSeller_Active.php"</script>';
    }
?>

<?php include("Interface/footer.php"); ?>