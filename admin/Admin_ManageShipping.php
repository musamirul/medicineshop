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
    <input type="text" name="method" placeholder="Enter method"/><br/>
    <input type="number" name="price" placeholder="Enter price"/><br/>
    <button type="submit" name="createShipping">New Shipping Method</button>
</form>

<?php
    if(isset($_POST['createShipping'])){
        $method = $_POST['method'];
        $price = $_POST['price'];

        
        //insert into login table
        $query_createAdmin = mysqli_query($con,"INSERT INTO login(username, password, role) VALUES ('$username','$password','administrator')");

        //clear post request
        $_SESSION['message']="successfully created account $username";
        header('Location:Admin_Registration.php?msg=success');
    }
?>