<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['role']!="administrator"){
        session_unset();
        header("Location:../login.php");
    }
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>
<h2>Manage Shipping Delivery Method</h2>
<form method="post">
    method <input type="text" name="method" placeholder="Enter method"/><br/>
    price <input type="text" name="price" placeholder="Enter price"/><br/>
    Number of days <input type="number" name="days" placeholder="Enter No of days"/><br/>
    <button type="submit" name="createShipping">New Shipping Method</button>
</form>

<?php
    if(isset($_POST['createShipping'])){
        $method = $_POST['method'];
        $price = $_POST['price'];
        $days = $_POST['days'];

        
        //insert into login table
        $query_createAdmin = mysqli_query($con,"INSERT INTO shipping(Shipping_Method, Shipping_Price, shipping_day) VALUES ('$method','$price','$days')");

        //clear post request
        $_SESSION['message']="successfully created $method shipping";
        header('Location:Admin_ManageShipping.php?msg=success');
    }
?>