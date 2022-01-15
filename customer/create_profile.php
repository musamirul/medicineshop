<?php include("Interface/header_create_profile.php");?>

<?php
session_start();
include("../includes/config.php");
if($_SESSION['username']==""){
    header("location:../login.php");
}
$username = $_SESSION['username'];
?>

<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <h5>Please fill in below information to complete registration</h5>
            <form method="POST">
                <div class="row mb-3 mt-4">
                    <input type="text" class="form-control" value="<?php echo $_SESSION['username'] ?>" disabled/>
                </div>
                <div class="row mb-3">
                    <input type="text" class="form-control" name="name" placeholder="Please Enter your fullname"/>
                </div>
                <div class="row mb-3">
                    <label class="form-label">Date of Birth</label>
                    <input class="form-control" type="date" name="dob"/>
                </div>
                <div class="row mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" value="male">
                        <label class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="gender" value="female">
                        <label class="form-check-label">Female</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="gender" value="other">
                        <label class="form-check-label">Other</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <input type="number" class="form-control" name="phone" placeholder="Please Enter your Phone no"/>
                 </div>
                 <div class="row mb-3">
                    <input type="text" class="form-control" name="email" placeholder="Please Enter your email address"/>
                </div>
                <div class="d-grid gap-1">
                    <button class="btn btn-primary" name="Save" type="submit">Save</button>
                </div>
            </form>
        </div>
        <div class="col-3"></div>
    </div>
</div>


<?php
//Get login id
$query_get_loginID = mysqli_query($con,"SELECT * FROM login WHERE username = '$username'");
$result_get_loginID = mysqli_fetch_array($query_get_loginID);
$loginID = $result_get_loginID['Login_ID'];

  //insert into database
if(isset($_POST['Save'])){
    $name = $_POST['name'];
    echo $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $query_save = mysqli_query($con,"INSERT INTO customer(Cust_Name, Cust_DOB, Cust_Gender, Cust_Phone, Cust_Email, FK_Cust_Login_ID) 
                                VALUES ('$name','$dob','$gender','$phone','$email','$loginID')");

    //kill all the session and go to login page
    $_SESSION['username'] = "";
    $_SESSION['role'] = "";
    $_SESSION['cust_id'] = "";
    session_unset();

    $_SESSION['message'] = "yours account have activated, please login";
    echo '<script>window.location.href="../Login.php"</script>';
}

?>

<?php include("Interface/footer.php");