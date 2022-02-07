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
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-journals"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Health Information</span> <br/>
                    <span style="font-size: 14px; color: grey;">Create a Health Information</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
            <div class="col-12">
                <textarea id="summernote_spec" class="form-control" rows="5" cols="500" name="specification" placeholder="Enter Product Specification"></textarea>
            </div>
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