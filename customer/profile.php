<?php
    session_start();
    include("../includes/config.php");
    echo $_SESSION['id'];
    echo $_SESSION['username'];
    echo $_SESSION['role'];
?>
<h4>My Profile</h4>
<p>Manage and protect your account</p>

<?php
//if profile already updated appear data only
$loginID = $_SESSION['id'];
$query_check = mysqli_query($con,"SELECT * FROM customer WHERE FK_Cust_Login_ID = '$loginID'");
$result_check = mysqli_fetch_array($query_check);
if($result_check>0){
    echo $_SESSION['username'];
    echo "<br>";
    echo $result_check['Cust_Name'];
    echo "<br>";
    echo $result_check['Cust_DOB'];
    echo "<br>";
    echo $result_check['Cust_Gender'];
    echo "<br>";
    echo $result_check['Cust_Phone'];
    echo "<br>";
    echo $result_check['Cust_Email'];

}else{

//if profile is not updated appear create new profile
?>
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
  //insert into database
    if(isset($_POST['Save'])){
        $name = $_POST['name'];
        echo $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $query_save = mysqli_query($con,"INSERT INTO customer(Cust_Name, Cust_DOB, Cust_Gender, Cust_Phone, Cust_Email, FK_Cust_Login_ID) 
                                    VALUES ('$name','$dob','$gender','$phone','$email','$loginID')");
    }
}
?>

