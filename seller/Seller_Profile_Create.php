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
    
?>