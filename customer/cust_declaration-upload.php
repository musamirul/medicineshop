
<?php include("Interface/header.php")?>
<?php

    $Cust_Id = $_SESSION['Cust_Id'];
    $current_file_name = basename($_SERVER['PHP_SELF']); 
?>

<div class="row mt-5">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <?php include("Interface/sidebar.php") ?>
        </div>
        <div class="col-6 bg-white">
            <div class="m-3">
                <h5>Declaration Files</h5>
                <span style="font-size: 13px;">Manage and protect your declaration files</span><br/>
                <span class="text-danger" style="font-size: 13px;">*Please upload Less than 2MB</span>
                <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div  class="ms-5 me-5">
                    <form enctype="multipart/form-data" method="post">
                    <div style="padding: 20px;" class="row shadow bg-body rounded">
                        <div class="col"><input class="form-control" type="file" name="file"/></div>
                        <div class="col"><input type="text" class ="form-control" name="fileName" placeholder="Enter File Type" /></div>
                        <div class="col"><button type="submit" class="btn btn-primary" name="submit">Submit</button></div>   
                    </div>
                    </form>
                    <span class="d-grid mx-auto mt-5 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                    <div style="padding: 20px;" class="row mt-5 shadow bg-body rounded">
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
                                    $query_showDoc = mysqli_query($con,"SELECT * FROM declaration WHERE FK_Declaration_Cust_ID = '$Cust_Id'");
                                    while($result_showDoc = mysqli_fetch_array($query_showDoc)){
                                        $recordID = $result_showDoc['Declaration_ID'];
                                        $name = $result_showDoc['Declaration_FileName'];   
                                ?>
                                <tr>
                                    <td><?php echo $result_showDoc['Declaration_ID']?></td>
                                    <td><?php echo $result_showDoc['Declaration_Name']?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $result_showDoc['Declaration_TimeStamp']?></td>
                                    <td>
                                    <div class="d-flex flex-row bd-highlight">
                                            <div class="pe-2 bd-highlight">
                                                <a href="cust_declaration-download.php?filename=<?php echo $name;?>&f=<?php echo $result_showDoc['Declaration_File']?>"><button class="btn btn-primary">Download</button></a>
                                            </div>
                                            <div class="bd-highlight">
                                                <form method="post">
                                                    <input type="hidden" name="recordID" value="<?php echo $recordID; ?>" />
                                                    <button type="submit" name="deleteRecord" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
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
    $fileName = $_POST['fileName'];


    //get date and time
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d h:i:sa");

    $fname = date("YmdHis").'_'.$name;
    $move = move_uploaded_file($temp,"upload/".$fname);
    
    $query_uploadFile=mysqli_query($con,"INSERT INTO declaration(Declaration_Name, Declaration_FileName, Declaration_File, Declaration_TimeStamp, FK_Declaration_Cust_ID) 
    VALUES ('$fileName','$name','$fname','$date','$Cust_Id')");
    echo '<script>window.location.href="cust_declaration-upload.php?msg=success"</script>';
    
}
if(isset($_POST['deleteRecord'])){
    $recordID = $_POST['recordID'];

    $query_deleteRecord = mysqli_query($con,"DELETE FROM record WHERE Record_ID = '$recordID'");
    $_SESSION['message'] = "record successfully deleted";
    echo '<script>window.location.href="cust_declaration-upload.php?msg=success"</script>';
}
?>
<?php include("Interface/footer.php")?>