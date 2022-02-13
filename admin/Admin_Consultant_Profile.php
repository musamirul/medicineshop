<?php include("Interface/header.php"); ?>
<?php
    $AdminID = $_SESSION['Admin_Id'];
    $query_admin = mysqli_query($con,"SELECT * FROM administrator WHERE Admin_ID = '$AdminID'");
    $result_admin = mysqli_fetch_array($query_admin);

    $query_profile = mysqli_query($con, "SELECT * FROM consultant_profile WHERE FK_Consult_Profile_Admin_ID = '$AdminID'");
    $result_profile = mysqli_fetch_array($query_profile);
?>
<?php include("Message_Notification.php")?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="fa-solid fa-user-doctor pt-2"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">My Profile</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and update your profile</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5 ms-5 me-5">
        <div style="background-color: antiquewhite; " class="d-flex flex-row bd-highlight mb-3">
                <div style="width: 200px;" class="mb-3 mt-1 p-3">
                    <div class="position-relative">
                    <?php if($result_profile['Consult_Profile_Img']==""){ ?>
                        <input type="image" data-bs-toggle="modal" data-bs-target="#editProfile" src="tempProfile.png" class="rounded-circle position-absolute top-50 start-0" style="height: 125px; width: 145px;">                   
                    <?php }else{ ?>
                        <input type="image" data-bs-toggle="modal" data-bs-target="#editProfile" src="img/<?php echo $result_profile['Consult_Profile_Img'] ?>" class="rounded-circle position-absolute top-50 start-0" style="height: 125px; width: 145px;">                   
                    <?php } ?>
                    </div>
                </div>
        <form method="post">
                <div class="mb-3 p-2">
                    <div class="d-flex flex-column bd-highlight">
                        <div style="font-size: 25px;" class="p-2 bd-highlight"><?php echo $result_admin['Admin_Name']; ?></div>
                        <div style="font-size: 13px; color: rgb(0, 119, 255);" class="ps-2 bd-highlight"><?php echo $result_admin['Admin_EmpNo']; ?></div>
                        <div style="font-size: 13px; color: rgb(0, 119, 255);" class="ps-2 bd-highlight"><?php echo $result_admin['Admin_Email']; ?></div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Speciality </label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="speciality" placeholder="Please Enter your Speciality"><?php if(!empty($result_profile['Consult_Profile_Speciality'])){ echo $result_profile['Consult_Profile_Speciality']; }?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Education </label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="education" placeholder="Please Enter your Education"><?php if(!empty($result_profile['Consult_Profile_Education'])){ echo $result_profile['Consult_Profile_Education']; }?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Language </label>
                <div class="col-sm-10">
                    <select data-placeholder="Begin typing a language to filter..." multiple class="chosen-select form-select" name="language[]">
                        <option value=""></option>
                        <option value="English">English</option>
                        <option value="Bahasa Melayu">Bahasa Melayu</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Tamil">Tamil</option>
                        <option value="Japanese">Japanese</option>
                        <option value="Korean">Korean</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Phone </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" placeholder="Please Enter your phone number" value="<?php if(!empty($result_profile['Consult_Profile_Phone'])){ echo $result_profile['Consult_Profile_Phone']; }?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Experience Since </label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="experience" placeholder="Please Enter your Employee Number" value="<?php if(!empty($result_profile['Consult_Profile_Experience'])){ echo $result_profile['Consult_Profile_Experience']; }?>"/>
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

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit <strong>Profile Image</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          <form enctype="multipart/form-data" method="post">
            <div class="modal-body">
                <div class="form-group row">
                <div class="col-sm-12">
                <label>Image Location :</label>
                        <div class="col"><input class="form-control" type="file" name="Profilefile"/></div>
                </div>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="editProfileBtn" class="btn btn-primary">Edit</button>
          </form>
          </div>   
        </div>
    </div>
</div>


<?php
    if(isset($_POST['editProfileBtn'])){
        
        $name=$_FILES['Profilefile']['name'];
        $size=$_FILES['Profilefile']['size'];
        $type=$_FILES['Profilefile']['type'];
        $temp=$_FILES['Profilefile']['tmp_name'];

        //get date and time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Y-m-d h:i:sa");

        $fname = date("YmdHis").'_'.$name;
        $move = move_uploaded_file($temp,"img/".$fname);

        $query_updateProfile = mysqli_query($con,"UPDATE consultant_profile SET Consult_Profile_Img='$fname' WHERE FK_Consult_Profile_Admin_ID = '$AdminID'");
        echo '<script>window.location.href="Admin_Consultant_Profile.php?msg=success"</script>';

    }

    if(isset($_POST['updateInfoBtn'])){
        echo $speciality = $_POST['speciality'];
        echo $education = $_POST['education'];
        $language = $_POST['language'];
        echo $phone = $_POST['phone'];
        echo $experience = $_POST['experience'];

        $languageArr = array();
        foreach($language as $value){
            array_push($languageArr,$value);
        }
        $valuesImplode = implode(", ", $languageArr);

        $query_updateProfile1 = mysqli_query($con,"UPDATE consultant_profile SET Consult_Profile_Speciality='$speciality',Consult_Profile_Education='$education',
        Consult_Profile_Language='$valuesImplode',Consult_Profile_Phone='$phone',Consult_Profile_Experience='$experience' WHERE FK_Consult_Profile_Admin_ID = '$AdminID'");

        $_SESSION['message'] = 'Successfully update information';   
        echo '<script>window.location.href="Admin_Consultant_Profile.php?msg=success"</script>';
        

    }
?>
<?php include("Interface/footer.php"); ?>