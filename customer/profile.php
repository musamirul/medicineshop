
<?php include("Interface/header.php")?>
<?php
    $current_file_name = basename($_SERVER['PHP_SELF']); 
?>
    <div class="row mt-5">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <?php include("Interface/sidebar.php") ?>
        </div>
        <!-- Profile Account -->
        <div class="col-6 bg-white">
            <div class="m-3">
                <h5>My Profile</h5>
                <span style="font-size: 13px;">Manage and protect your account</span>
                <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div class="ms-5 me-5">
                <?php
                    $loginID = $_SESSION['id'];
                    $query_check = mysqli_query($con,"SELECT * FROM customer WHERE FK_Cust_Login_ID = '$loginID'");
                    $result_check = mysqli_fetch_array($query_check);
                    if($result_check>0){
                ?>
                        <form method="POST">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $_SESSION['username'] ?>" disabled/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="Please Enter your fullname" value="<?php echo $result_check['Cust_Name']; ?>"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">DOB</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="dob" value="<?php echo $result_check['Cust_DOB'] ?>"/>
                                </div>
                            </div>
                            <?php if($result_check['Cust_Gender']=="male") {?>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="male" checked>
                                        <label class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="female">
                                        <label class="form-check-label">Female</label>
                                        
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="other">
                                        <label class="form-check-label">Others</label>
                                    </div>
                                </div>
                            <?php }elseif($result_check['Cust_Gender']=="female"){ ?>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="male">
                                        <label class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="female" checked>
                                        <label class="form-check-label">Female</label>
                                        
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="other">
                                        <label class="form-check-label">Others</label>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="male">
                                        <label class="form-check-label">Male</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="female">
                                        <label class="form-check-label">Female</label>
                                        
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="gender" value="other" checked>
                                        <label class="form-check-label">Others</label>
                                    </div>
                                </div>
                            <?php } ?>
                            
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="phone" placeholder="Please Enter your Phone no" value="<?php echo $result_check['Cust_Phone'] ?>"/>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" placeholder="Please Enter your email address" value="<?php echo $result_check['Cust_Email'] ?>"/>
                                </div>
                            </div>
                            <div class="row mt-5 mb-5">
                                <button class="btn btn-primary" name="Update" type="submit">Update</button>
                            </div>
                            </form>
                <!--Start of Empty Form-->
                <?php }else{ ?>
                    <form method="POST">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $_SESSION['username'] ?>" disabled/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" placeholder="Please Enter your fullname"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">DOB</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="dob"/>
                            </div>
                        </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Gender</label>
                                <div class="form-check ms-5">
                                    <input type="radio" class="form-check-input" name="gender" value="male" checked>
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check ms-5">
                                    <input type="radio" class="form-check-input" name="gender" value="female">
                                    <label class="form-check-label">Female</label>
                                    
                                </div>
                                <div class="form-check ms-5">
                                    <input type="radio" class="form-check-input" name="gender" value="other">
                                    <label class="form-check-label">Others</label>
                                </div>
                            </div>
                        
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="phone" placeholder="Please Enter your Phone no"/>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email" placeholder="Please Enter your email address"/>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5">
                            <button class="btn btn-primary" name="Save" type="submit">Save</button>
                        </div>
                        </form>
                <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>






<?php
  //insert into database
    if(isset($_POST['Save'])){
        $name = $_POST['name'];
        echo $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $query_save = mysqli_query($con,"INSERT INTO customer(Cust_Name, Cust_DOB, Cust_Gender, Cust_Phone, Cust_Email, Cust_Status, FK_Cust_Login_ID) 
                                    VALUES ('$name','$dob','$gender','$phone','$email','Active','$loginID')");
        echo '<script>window.location.href="profile.php"</script>';
    }
    

?>

<?php
  //update into database
    if(isset($_POST['Update'])){
        echo $name = $_POST['name'];
        echo "<br/>";
        echo $dob = $_POST['dob'];
        echo "<br/>";
        echo $gender = $_POST['gender'];
        echo "<br/>";
        echo $phone = $_POST['phone'];
        echo "<br/>";
        echo $email = $_POST['email'];
        echo "<br/>";
        echo $loginID;
        $query_update = mysqli_query($con,"UPDATE customer SET Cust_Name='$name',Cust_DOB='$dob',
                                    Cust_Gender='$gender',Cust_Phone='$phone',Cust_Email='$email' WHERE FK_Cust_Login_ID = '$loginID'");
        echo '<script>window.location.href="profile.php"</script>';
    }
    

?>

<?php include("Interface/footer.php")?>
