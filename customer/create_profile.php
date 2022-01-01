<?php
session_start();
include("../includes/config.php");
if($_SESSION['username']==""){
    header("location:../login.php");
}
$username = $_SESSION['username'];
?>
<h2>Please fill in below information to complete registration</h2>
<form method="POST">
    <input type="text" value="<?php echo $_SESSION['username'] ?>" disabled/> <br/>
    <input type="text" name="name" placeholder="Please Enter your fullname"/> <br/>
    <input type="date" name="dob"/><br/>
    <input type="radio" name="gender" value="male">Male
    <input type="radio" name="gender" value="female">Female
    <input type="radio" name="gender" value="other">Other <br/>
    <input type="number" name="phone" placeholder="Please Enter your Phone no"/> <br/>
    <input type="text" name="email" placeholder="Please Enter your email address"/><br/>
    <button name="Save" type="submit">Save</button>
</form>
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
    header("location:../login.php");
}

?>