<?php include("Interface/header.php"); ?>
<?php
session_start();
include('../includes/config.php');
if($_SESSION['role']!="administrator"){
    session_unset();
    header("Location:../login.php");
}

//get id from url link
$id = intval($_GET['id']);

//show seller data inside form
$query_sellerData = mysqli_query($con,"SELECT * FROM `seller` WHERE Seller_ID = '$id'");
$result_sellerData = mysqli_fetch_array($query_sellerData);
?>
<h2>Update Seller Information</h2>
<form method="post">
    <input type="text" name="name" value="<?php echo $result_sellerData['Seller_Name'];?>"/><br/>
    <input type="number" name="regNo" value="<?php echo $result_sellerData['Seller_RegistrationNo'];?>"/><br/>
    <input type="number" name="phone" value="<?php echo $result_sellerData['Seller_Phone'];?>"/><br/>
    <textarea rows="5" cols="50" name="address"><?php echo $result_sellerData['Seller_Address'];?></textarea><br/>
    <input type="text" name="bankName" value="<?php echo $result_sellerData['Seller_BankAccName'];?>"/><br/>
    <input type="number" name="bankNo" value="<?php echo $result_sellerData['Seller_BankAccNo'];?>"/><br/>
    <select name="RegStat">
                <option value="Active" selected>Activate</option>
                <option value="Decline">Decline</option>
                <option value="Suspend">Suspend</option>
    </select><br/>
    <button type="submit" name="Btn-updateSeller">Update</button>
</form>

<?php
    
    if(isset($_POST['Btn-updateSeller'])){
        $name = $_POST['name'];
        $regNo = $_POST['regNo'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $bankName = $_POST['bankName'];
        $bankNo = $_POST['bankNo'];
        $Regstat = $_POST['RegStat'];

        //update seller with new data
        $query_sellerUpdate = mysqli_query($con,"UPDATE seller SET Seller_Name='$name',Seller_RegistrationNo='$regNo',Seller_Phone='$phone',
        Seller_Address='$address',Seller_BankAccName='$bankName',Seller_BankAccNo='$bankNo',Seller_Registration_Status='$Regstat' WHERE Seller_ID = '$id'");

        //clear post request

    }
?>
