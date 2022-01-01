<?php
    session_start();
    include("includes/config.php");
?>
<h2>Registration</h2>
<form method="post">
    <input type="text" name="username" placeholder="Enter Username"/>
    <input type="password" name="password" placeholder="Enter Password"/>
    <button name="CreateAccountBtn" type="submit">Create Account</button>
</form> 
<?php
if(isset($_POST['CreateAccountBtn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //Check if username already exist
    $Query_Check = mysqli_query($con,"SELECT * FROM login WHERE username ='$username'");
    $Result = mysqli_fetch_array($Query_Check);

    if($Result>0){
        echo 'found';
    }else{
        //If username not exist insert into 'login' db
        $Query_Submit = mysqli_query($con, "INSERT INTO login ( username, password, role) VALUES ('$username','$password','customer')");
        $_SESSION['username'] = $_POST['username'];
        header("location:http://localhost/medicineshop/customer/create_profile.php");
            
    }
    
}
?>
