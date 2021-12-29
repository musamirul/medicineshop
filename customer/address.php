<?php
session_start();
include("../includes/config.php");
if($_SESSION['id']==""){
    header("location:http://localhost/medicineshop/login.php");
}
$loginId = $_SESSION['id'];
?>
<h1>My Addresses</h1>
<button name="btn_add_ship_address">Add Shipping Address</button>
<button name="btn_add_bill_address">Add Billing Address</button>

<!-- Enter Shipping Address -->
<h2>Shipping Address</h2>
<form method="POST">
    <textarea rows="5" cols="50" name="address" placeholder="Enter address"></textarea><br/>
    <input type="text" name="city" placeholder="Enter city name"></br>
    <select name="state">
        <option value="Selangor" selected>Selangor</option>
        <option value="Johor">Johor</option>
        <option value="Kedah">Kedah</option>
        <option value="Kelantan">Kelantan</option>
        <option value="Malacca">Malacca</option>
        <option value="Pahang">Pahang</option>
        <option value="Penang">Perak</option>
        <option value="Perlis">Perlis</option>
        <option value="Sabah">Sabah</option>
        <option value="Sarawak">Sarawak</option>
        <option value="Terengganu">Terengganu</option>
        <option value="Kuala_Lumpur">Kuala Lumpur</option>
        <option value="Labuan">Labuan</option>
        <option value="Putrajaya">Putrajaya</option> 
    </select><br/>
    <input type="number" name="zipcode" placeholder="Enter Zipcode"></br>
    <select name="country">
        <option value="Malaysia" selected>Malaysia</option>
        <option value="Singapura">Singapura</option>
        <option value="Indonesia">Indonesia</option>
    </select><br/>
    <button name="btn_save_ship">Save Shipping Address</button>
</form>
<?php
if(isset($_POST['btn_save_ship'])){
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $country = $_POST['country'];
    $query_ship = mysqli_query($con,"INSERT INTO shipping_address(address, city,state, zipcode, country, FK_ShipAdd_Cust_ID) 
    VALUES ('$address','$city','$state','$zipcode','$country','$loginId')");
}
?>

<!-- Enter Bill Address -->
<h2>Billing Address</h2>
<form method="POST">
    <textarea rows="5" cols="50" name="bill_address" placeholder="Enter address"></textarea><br/>
    <input type="text" name="bill_city" placeholder="Enter city name"></br>
    <select name="bill_state">
        <option value="Selangor" selected>Selangor</option>
        <option value="Johor">Johor</option>
        <option value="Kedah">Kedah</option>
        <option value="Kelantan">Kelantan</option>
        <option value="Malacca">Malacca</option>
        <option value="Pahang">Pahang</option>
        <option value="Penang">Perak</option>
        <option value="Perlis">Perlis</option>
        <option value="Sabah">Sabah</option>
        <option value="Sarawak">Sarawak</option>
        <option value="Terengganu">Terengganu</option>
        <option value="Kuala_Lumpur">Kuala Lumpur</option>
        <option value="Labuan">Labuan</option>
        <option value="Putrajaya">Putrajaya</option> 
    </select><br/>
    <input type="number" name="bill_zipcode" placeholder="Enter Zipcode"></br>
    <select name="bill_country">
        <option value="Malaysia" selected>Malaysia</option>
        <option value="Singapura">Singapura</option>
        <option value="Indonesia">Indonesia</option>
    </select><br/>
    <button name="btn_save_bill">Save Billing Address</button>
</form>
<?php
if(isset($_POST['btn_save_bill'])){
    $bill_address = $_POST['bill_address'];
    $bill_city = $_POST['bill_city'];
    $bill_state = $_POST['bill_state'];
    $bill_zipcode = $_POST['bill_zipcode'];
    $bill_country = $_POST['bill_country'];
    $query_bill = mysqli_query($con,"INSERT INTO `billing_address`(address, city, state, zipcode, country, FK_BillAdd_Cust_ID) 
    VALUES ('$bill_address','$bill_city','$bill_state','$bill_zipcode','$bill_country',$loginId)");
}
?>