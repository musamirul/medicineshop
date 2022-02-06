<?php include("Interface/header.php"); ?>
<?php 
    //Count All
    $query_countall = mysqli_query($con,"SELECT count(*) FROM consult");
    $result_countall = mysqli_fetch_array($query_countall);
    $allcount = $result_countall[0];

    //Count request
    $query_countactive = mysqli_query($con,"SELECT count(*) FROM consult WHERE Consult_Status = 'request'");
    $result_countactive = mysqli_fetch_array($query_countactive);
    $activecount = $result_countactive[0];

    //count complete
    $query_countcomplete = mysqli_query($con,"SELECT count(*) FROM consult WHERE Consult_Status = 'complete'");
    $result_countcomplete = mysqli_fetch_array($query_countcomplete);
    $completecount = $result_countcomplete[0];

    //count cancel
    $query_countcancel= mysqli_query($con,"SELECT count(*) FROM consult WHERE Consult_Status = 'cancel'");
    $result_countcancel = mysqli_fetch_array($query_countcancel);
    $cancelcount = $result_countcancel[0];

?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-person-fill"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Consultation Management</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and manage Customer Consultation</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <!-- Customer table -->
            <div class="col">
                <div class="row bg-white p-3">
                    <ul class="nav nav-pills d-flex justify-content-start">
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Admin_Consultation.php"><center>All<span class="shadow badge bg-secondary ms-3"><?php echo $allcount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_Consultation_Request.php"><center>Request<span class="shadow badge bg-secondary ms-3"><?php echo $activecount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_Consultation_Complete.php"><center>Complete<span class="shadow badge bg-secondary ms-3"><?php echo $completecount ?></span></center></a>
                        </li>
                        <li style="width: 170px;" class="nav-item">
                            <a class="nav-link text-reset" href="Admin_Consultation_Cancel.php"><center>Cancel<span class="shadow badge bg-secondary ms-3"><?php echo $cancelcount ?></span></center></a>
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
                        <th>Cust ID</th>
                        <th>Cust Name</th>
                        <th>Phone No</th>
                        <th>Email</th>
                        <th>Request Date</th>
                        <th>Request Time</th>
                        <th>Consult Status</th>
                        <th>Product Request</th>
                        <th>Medical History</th>
                        <th>Upload Prescription</th>
                        <th>Consult Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //display all table data
                        $query_showData = mysqli_query($con,"SELECT * FROM consult");
                        while($result_showData = mysqli_fetch_array($query_showData)){
                            $Cust_ID = $result_showData['FK_Consult_Cust_ID']; 
                            $query_customer = mysqli_query($con,"SELECT * FROM customer WHERE Cust_ID = '$Cust_ID'");
                            $result_customer = mysqli_fetch_array($query_customer);

                            $Product_ID = $result_showData['FK_Consult_Product_ID'];
                            $query_product = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$Product_ID'");
                            $result_product = mysqli_fetch_array($query_product);

                            $consult_id = $result_showData['Consult_ID'];
                            

                    ?>
                    <tr>
                        <td><?php echo $result_customer['Cust_ID']; ?></td>
                        <td><?php echo $result_customer['Cust_Name']; ?></td>
                        <td><?php echo $result_customer['Cust_Phone']; ?></td>
                        <td><?php echo $result_customer['Cust_Email']; ?></td>
                        <td><?php echo $result_showData['Consult_RegDate']; ?></td>
                        <td><?php echo $result_showData['Consult_RegTime']; ?></td>
                        <td><?php echo $result_showData['Consult_Status']; ?></td>
                        <td><a class="text-decoration-none" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#product<?php echo $Product_ID ?>" href=""><?php echo $result_product['Product_Name']; ?></a></td>
                        <td><a class="text-decoration-none" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medHis<?php echo $Cust_ID ?>" href="">View</a></td>
                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload<?php echo $Cust_ID ?>">Upload</button></td>
                        <td>
                            <form method="post">
                            <select class="form-select form-select-sm" name="status">
                                <option value="complete">complete</option>
                                <option value="cancel">cancel</option>                           
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-primary" type="submit" name="saveDetail">Update</button>
                            </form>
                        </td>
                    </tr>
                        <!-- View Seller -->
                        <div class="modal fade" id="upload<?php echo $Cust_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Upload Prescription <strong>#<?php echo $result_customer['Cust_Name']; ?></strong></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="col"><input class="form-control" type="file" name="file"/></div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $result_customer['Cust_ID']; ?>" name="cust_ID">
                                    <input type="hidden" value="<?php echo $consult_id; ?>" name="consult_ID">
                                    <button class="btn btn-primary" name="uploadBtn" type="submit">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </form>   
                            </div>
                            </div>
                        </div>
                        <!-- End Seller -->

                        <!-- View Medical History -->
                        <div class="modal fade" id="medHis<?php echo $Cust_ID; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Medical History & Declaration</strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                        <div class="col-sm-12">
                                            <?php 
                                            $query_medical_history = mysqli_query($con,"SELECT * FROM medical_history WHERE FK_Med_Cust_ID='$Cust_ID'");
                                            $result_medical_history = mysqli_fetch_array($query_medical_history);
                                            
                                            ?>
                                                <div class="row mt-2 p-2">
                                                    <div class="d-flex flex-column bd-highlight">
                                                        <div style="font-size: 20px;" class="p-2 bd-highlight"><?php echo $result_customer['Cust_Name']; ?></div>
                                                        <div style="font-size: 13px; color: rgb(0, 119, 255);" class="ps-2 bd-highlight"><?php echo $result_customer['Cust_Phone']; ?></div>
                                                        <div style="font-size: 13px; color: rgb(0, 119, 255);" class="ps-2 bd-highlight"><?php echo $result_customer['Cust_Email']; ?></div>
                                                    </div>
                                                    <div class="d-flex flex-row bd-highlight mb-3">
                                                        <div style="font-size: 13px; color:grey;" class="p-2 bd-highlight">Date of Birth : <?php echo $result_customer['Cust_DOB']; ?></div>
                                                        <div style="font-size: 13px; color: grey;" class="p-2 bd-highlight">Gender : <?php echo $result_customer['Cust_Gender']; ?></div>
                                                    </div>
                                                    <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                                
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Blood Group:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Blood_Group']; ?></div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Weight:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Weight']; ?>kg</div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Height:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Height']; ?>cm</div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">BMI:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['BMI']; ?>cm</div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Drinking Alcohol?:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Alcohol']; ?></div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Smoking?:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Smoking']; ?></div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Regularly Exercise?:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Exercise']; ?></div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Previous & Current Illness:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Illness']; ?></div>
                                                </div>
                                                <div style="font-size: 13px" class="row ps-3 pb-2">
                                                    <div class="col-3">Previous & Current Surgery:</div>
                                                    <div class="col float-start"><?php echo $result_medical_history['Surgery']; ?></div>
                                                </div>
                                                <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                                                <div class="row mt-3">
                                                    <span style="font-size: 20px;" >Declaration Files</span>
                                                    <div style="padding: 20px;" class="row shadow bg-body rounded">
                                                    <table id="example" class="display center" style="width: 100%; text-align: center;">
                                                        <thead>
                                                        <tr>
                                                            <th>Record ID</th>
                                                            <th>Types</th>
                                                            <th>Files Name</th>
                                                            <th>TimeStamp</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                                $query_showDoc = mysqli_query($con,"SELECT * FROM declaration WHERE FK_Declaration_Cust_ID = '$Cust_ID'");
                                                                while($result_showDoc = mysqli_fetch_array($query_showDoc)){
                                                                    $name = $result_showDoc['Declaration_FileName'];   
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $result_showDoc['Declaration_ID']?></td>
                                                                <td><?php echo $result_showDoc['Declaration_Name']?></td>
                                                                <td><?php echo $name; ?></td>
                                                                <td><?php echo $result_showDoc['Declaration_TimeStamp']?></td>
                                                                <td><a href="../customer/cust_declaration-download.php?filename=<?php echo $name;?>&f=<?php echo $result_showDoc['Declaration_File']?>"><button>Download</button></a></td>
                                                            </tr>
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </form>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <!-- End Medical History-->

                        <!-- View Product -->
                        <div class="modal fade" id="product<?php echo $Product_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel"><strong><?php echo $result_product['Product_Name']; ?></strong></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col">
                                        <div class="row"><img class="img-fluid" style="height: 25rem;" src="../seller/<?php echo $result_product['Product_Image']; ?>"></div>
                                        <div class="row p-2">
                                            <div class="d-flex flex-column bd-highlight">
                                                <div class="bd-highlight pb-1"><strong>Manufacturer by</strong></div>
                                                <div class="bd-highlight"><?php echo $result_product['Product_ManufacturerName']; ?></div>
                                            </div>
                                        </div>
                                        <div class="row p-2">
                                            <div class="d-flex flex-column bd-highlight mb-3">
                                                <div class="bd-highlight pb-1"><strong>Description</strong></div>
                                                <div class="bd-highlight"><?php echo $result_product['Product_Desc']; ?></div>
                                              </div>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
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
    if(isset($_POST['uploadBtn'])){
        $presCust_ID = $_POST['cust_ID'];
        echo $name=$_FILES['file']['name'];
        echo $size=$_FILES['file']['size'];
        echo $type=$_FILES['file']['type'];
        echo $temp=$_FILES['file']['tmp_name'];


        //get date and time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Y-m-d h:i:sa");

        $fname = date("YmdHis").'_'.$name;
        $move = move_uploaded_file($temp,"../customer/upload/".$fname);
        
        $query_uploadFile=mysqli_query($con,"INSERT INTO record(Record_Timestamp, Record_File, Record_FileName, FK_Record_Product_ID, FK_Record_Cust_ID)
        VALUES ('$date','$fname','$name','0','$presCust_ID')");
        echo '<script>window.location.href="Admin_Consultation.php?msg=success"</script>';
    }
?>
<?php
    if(isset($_POST['saveDetail'])){
        $status = $_POST['status'];
        $consult_ID = $_POST['consult_ID'];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d-m-Y');
        $todayTime = date('h:i:s a');

        
        
        echo '<script>window.location.href="Admin_ManageCust.php"</script>';
    }
?>

<?php include("Interface/footer.php"); ?>