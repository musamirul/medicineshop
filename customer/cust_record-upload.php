<?php include("Interface/header.php")?>
<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['username']=="" || $_SESSION['role']!="customer"){
        session_unset();
        header("location:../login.php");
    }
    $Cust_Id = $_SESSION['Cust_Id'];
?>

<div class="row">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <div class="list-group list-group-flush mx-3 mt-4">
                <!-- Collapse 1 -->
                <a class="list-group-item list-group-item-action py-2" aria-current="true" data-bs-toggle="collapse" href="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
                  <i class="bi bi-person fa-fw me-3"></i><span>My Account</span>
                </a>
                <!-- Collapsed content -->
                <ul id="collapseAccount" class="collapse list-group list-group-flush">
                  <li class="list-group-item py-1">
                    <a href="profile.php" class="text-reset text-decoration-none">Profile</a>
                  </li>
                  <li class="list-group-item py-1">
                    <a href="" class="text-reset text-decoration-none">Banks</a>
                  </li>
                  <li class="list-group-item py-1">
                    <a href="address.php" class="text-reset text-decoration-none">Addresses</a>
                  </li>
                  <li class="list-group-item py-1 ">
                    <a href="" class="text-reset text-decoration-none">Change Password</a>
                  </li>
                </ul>
                <a class="list-group-item list-group-item-action py-2"  href="">
                    <i class="bi bi-journal-check fa-fw me-3"></i><span>My Purchase</span>
                </a>
                <a class="list-group-item list-group-item-action py-2"  href="medical_history.php">
                    <i class="bi bi-file-earmark-medical fa-fw me-3"></i><span>Medical History</span>
                </a>
                <a class="list-group-item list-group-item-action py-2"  href="cust_record-upload.php">
                    <i class="bi bi-folder fa-fw me-3"></i><span>Record Upload</span>
                </a>
                <a class="list-group-item list-group-item-action py-2"  href="cust_declaration-upload.php">
                    <i class="bi bi-folder fa-fw me-3"></i><span>Declaration Upload</span>
                </a>
            </div>
            
        </div>
        <div class="col-6 bg-white">
            <div class="m-3">
                <h5>Record Files</h5>
                <span style="font-size: 13px;">Manage and protect your record files</span>
                <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div  class="ms-5 me-5">
                    <form enctype="multipart/form-data" method="post">
                    <div style="padding: 20px;" class="row shadow bg-body rounded">
                        <div class="col"><input class="form-control" type="file" name="file"/></div>
                        <div class="col"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>   
                    </div>
                    </form>
                    <span class="d-grid mx-auto mt-5 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                    <div style="padding: 20px;" class="row mt-5 shadow bg-body rounded">
                        <table id="example" class="display center" style="width: 100%; text-align: center;">
                            <thead>
                              <tr>
                                <th>Record ID</th>
                                <th>Files Name</th>
                                <th>TimeStamp</th>
                                <th>Action</th>
                              </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $query_showDoc = mysqli_query($con,"SELECT * FROM record WHERE FK_Record_Cust_ID = '$Cust_Id'");
                                    while($result_showDoc = mysqli_fetch_array($query_showDoc)){
                                        $name = $result_showDoc['Record_FileName'];     
                                ?>
                                <tr>
                                    <td><?php echo $result_showDoc['Record_ID'];?></td>
                                    <td><?php echo $name;?></td>
                                    <td><?php echo $result_showDoc['Record_Timestamp'];?></td>
                                    <td><a href="cust_declaration-download.php?filename=<?php echo $name;?>&f=<?php echo $result_showDoc['Record_File']?>"><button>Download</button></a></td>
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
        <div class="col-2"></div>
        <!-- Left Navigation -->
</div>

<?php
if(isset($_POST['submit'])){
    $name=$_FILES['file']['name'];
    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];


    //get date and time
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d h:i:sa");

    $fname = date("YmdHis").'_'.$name;
    $move = move_uploaded_file($temp,"upload/".$fname);
    
    $query_uploadFile=mysqli_query($con,"INSERT INTO record(Record_Timestamp, Record_File, Record_FileName, FK_Record_Product_ID, FK_Record_Cust_ID)
    VALUES ('$date','$fname','$name','0','$Cust_Id')");
    echo '<script>window.location.href="cust_record-upload.php?msg=success"</script>';
    //header("Location:cust_record-upload.php?msg=success");
    
}
?>
<?php include("Interface/footer.php")?>