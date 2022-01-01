<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['username']==""){
        header("location:../Login.php");
    }
?>
<h2>Please Fill in detail to complete registration</h2>

<form method="post">
    <input type="text" name="username" value="<?php echo $_SESSION['username'] ?>" disabled/><br/>
    <input type="text" name="name" placeholder="Enter Company Name"/><br/>
    <input type="number" name="registrationNo" placeholder="Enter Company Registration No"/><br />
    <input type="number" name="phone" placeholder="Enter Company Contact No"/><br/>
    <textarea rows="5" cols="50" name="address" placeholder="Enter Company Address"></textarea><br/>
    <input type="text" name="bankName" placeholder="Enter Bank Account Name"/><br/>
    <input type="number" name="bankNo" placeholder="Enter Bank Account No"/><br/>
    <button type="submit" name="saveDetail">Save</button> 
</form>

<?php
    if(isset($_POST['saveDetail'])){
        
        $username = $_SESSION['username'];
        $company = $_POST['name'];
        $registrationNo = $_POST['registrationNo'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $bankName = $_POST['bankName'];
        $bankNo = $_POST['bankNo'];

        //get seller loginID
        $query_getId = mysqli_query($con, "SELECT * FROM login WHERE username = '$username'");
        $result_getId = mysqli_fetch_array($query_getId);
        $loginID = $result_getId['Login_ID'];

        //insert into seller database
        $query_insert = mysqli_query($con,"INSERT INTO seller(Seller_Name, Seller_RegistrationNo, Seller_Phone, Seller_Address, Seller_BankAccName, Seller_BankAccNo, Seller_Registration_Status, FK_Seller_Login_ID)
        VALUES ('$company','$registrationNo','$phone','$address','$bankName','$bankNo','reqApproval','$loginID')");

        $_SESSION['message'] = "yours account have successfully created, waiting for administrator for approval";
        unset($_SESSION['username']);
        header('Location:../Login.php');
    }
?>