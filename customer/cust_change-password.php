<?php include("Interface/header.php")?>
<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['id']==""){
        header("location:http://localhost/medicineshop/login.php");
    }
    $_SESSION['id'];
    $_SESSION['username'];
    $_SESSION['role'];
    $_SESSION['Cust_Id'];
    $current_file_name = basename($_SERVER['PHP_SELF']); 
?>

    <div class="row">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <?php include("Interface/sidebar.php") ?>
        </div>
        <!-- Profile Account -->
        <div class="col-6 bg-white">
            <div class="m-3">
                <h5>Change Password</h5>
                <span style="font-size: 13px;">For your account's security, do not share your password with anyone else</span>
                <span class="d-grid mx-auto mt-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div class="ms-5 me-5 ">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <form method="post">
                                <div style="height: 50px;" class="row p-2 text-danger">
                                    <?php 
                                        if(isset($_SESSION['message'])){
                                            echo $_SESSION['message'];
                                            unset($_SESSION['message']);
                                        }  
                                    ?>                                 
                                </div>
                                <div class="row mb-3">
                                    <label style="font-size: 14px; color: grey;" class="col-sm-3 col-form-label">Current Password</label>
                                    <div class="col-sm-9">
                                    <input type="password" name="currentPass" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label style="font-size: 14px; color: grey;" class="col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                    <input type="password" name="newPass" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label style="font-size: 14px; color: grey;" class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                    <input type="password" name="confPass" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" name="changePassBtn" class="btn btn-primary float-end">Confirm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>

    <?php
        if(isset($_POST['changePassBtn'])){
            $currentPass = $_POST['currentPass'];
            $newPass = $_POST['newPass'];
            $confPass = $_POST['confPass'];
            $login_id = $_SESSION['id'];
            $query_Login = mysqli_query($con,"SELECT * FROM login WHERE Login_ID = '$login_id'");
            $result_Login = mysqli_fetch_array($query_Login);
            if($result_Login['password']!=$currentPass){
                $_SESSION['message'] = 'wrong current password';
                echo '<script>window.location.href="cust_change-password.php"</script>';
            }elseif($newPass!=$confPass){
                $_SESSION['message'] = 'Password entered is different';
                echo '<script>window.location.href="cust_change-password.php"</script>';
            }else{
                $_SESSION['message'] = 'Successfully entered new password';
                $query_Login_update = mysqli_query($con,"UPDATE login SET password='$confPass' WHERE Login_ID = '$login_id'");
                echo '<script>window.location.href="cust_change-password.php"</script>';
            }
        }
    ?>

<?php include("Interface/footer.php")?>
