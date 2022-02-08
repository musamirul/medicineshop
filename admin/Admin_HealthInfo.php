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
        <div class="row pt-2 ms-2 me-2">
            <div class="col-8">
                <form method="post">
                <textarea id="summernote_health" class="form-control" rows="5" cols="500" name="description" placeholder="Enter Article Text" required></textarea>
            </div>
            <div class="col-4">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Article Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Article Title"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Article Author</label>
                        <input type="text" class="form-control" name="author" placeholder="Enter Article Author"/>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Article Tags</label>
                        <textarea rows="5" class="form-control" name="tags" placeholder="Enter Article Tags" required></textarea>
                        <small style="color: red;" class="">NOTES:</small>
                        <small><i>Puts comma ',' after each tags</i></small>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <button type="submit" name="updateInfoBtn" class="btn btn-primary">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['updateInfoBtn'])){
        $description = str_replace("'", '', $_POST['description']) ;
        $title = $_POST['title'];
        $author = $_POST['author'];
        $tags = $_POST['tags'];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $todayDate = date('d-m-Y');
        $todayTime = date('h:i:s a');

        $query_information = mysqli_query($con,"INSERT INTO healthinfo(HealthInfo_Title, HealthInfo_Desc, HealthInfo_Date, HealthInfo_Time, HealthInfo_Tags, HealthInfo_Author,FK_HealthInfo_Admin_ID) 
        VALUES ('$title','$description','$todayDate','$todayTime','$tags','$author','$AdminID')");
        
        $_SESSION['message'] = 'Successfully update information';
        echo '<script>window.location.href="Admin_HealthInfo.php?msg=success"</script>';

    }
?>
<?php include("Interface/footer.php"); ?>