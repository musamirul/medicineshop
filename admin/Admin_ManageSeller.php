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
                            <a class="nav-link active" aria-current="page" href="Admin_ManageSeller.php"><center>All<span class="shadow badge bg-secondary ms-3"><?php echo $allcount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_ManageSeller_Active.php"><center>Active<span class="shadow badge bg-secondary ms-3"><?php echo $activecount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset <?php if($reqcount>0)echo 'bg-danger' ?>" href="Admin_ManageSeller_ReqApproval.php"><center><span class="<?php if($reqcount>0)echo 'text-white' ?>">Req. Approval</span><span class="shadow badge bg-secondary ms-3"><?php echo $reqcount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_ManageSeller_Deactive.php"><center>Deactive<span class="shadow badge bg-secondary ms-3"><?php echo $deactivecount ?></span></center></a>
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
                        $query_showData = mysqli_query($con,"SELECT * FROM seller");
                        while($result_showData = mysqli_fetch_array($query_showData)){
                        $Seller_ID = $result_showData['Seller_ID'] 
                    ?>
                    <tr>
                        <td><?php echo $result_showData['Seller_ID']; ?></td>
                        <td><?php echo $result_showData['Seller_Name']; ?></td>
                        <td><?php echo $result_showData['Seller_RegistrationNo']; ?></td>
                        <td><?php echo $result_showData['Seller_Phone']; ?></td>
                        <td><?php echo $result_showData['Seller_Address']; ?></td>
                        <td><?php echo $result_showData['Seller_Registration_Status']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SellerModal<?php echo $Seller_ID ?>">Edit</button>
                        </td>
                    </tr>
                        <!-- View Seller -->
                        <div class="modal fade" id="SellerModal<?php echo $Seller_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit profile <strong>#<?php echo $result_showData['Seller_Name']; ?></strong></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form method="POST">
                                    <div class="row mb-3 mt-4">
                                        <input type="text" class="form-control" name="name" value ="<?php echo $result_showData['Seller_Name']; ?>" required/>
                                    </div>
                                    <div class="row mb-3">
                                        <input type="number" class="form-control" name="phone" value ="<?php echo $result_showData['Seller_Phone']; ?>" required/>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="form-floating">
                                            <textarea class="form-control" name="address" placeholder="Enter Company Address" style="height: 100px"><?php echo $result_showData['Seller_Address']; ?></textarea>
                                            <label for="floatingTextarea2">Company Address</label>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <select class="form-select form-select-sm mb-3" name="status">
                                            <option value="Active" <?php if($result_showData['Seller_Registration_Status']=='Active'){echo 'selected';} ?>>Active</option>
                                            <option value="deactive" <?php if($result_showData['Seller_Registration_Status']=='deactive'){echo 'selected';}  ?>>Deactive</option>
                                            <option value="suspend" <?php if($result_showData['Seller_Registration_Status']=='suspend'){echo 'selected';}  ?>>Suspend</option>
                                            <option value="reqApproval" <?php if($result_showData['Seller_Registration_Status']=='reqApproval'){echo 'selected';}  ?>>ReqApproval</option>
                                        </select>
                                    </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $result_showData['Seller_ID']; ?>" name="seller_ID">
                                    <button class="btn btn-primary" name="saveDetail" type="submit">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </form>   
                            </div>
                            </div>
                        </div>
                        <!-- End Seller -->
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
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $status = $_POST['status'];

        $query_updateSeller = mysqli_query($con,"UPDATE `seller` SET Seller_Name='$name',Seller_Phone='$phone',
        Seller_Address='$address',Seller_Registration_Status='$status' WHERE Seller_ID = '$hseller_id'");
        
        echo '<script>window.location.href="Admin_ManageSeller.php"</script>';
    }
?>

<?php include("Interface/footer.php"); ?>