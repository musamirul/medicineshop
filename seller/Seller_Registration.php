<?php
    session_start();
    include("../includes/config.php");
?>
<h2>Register as seller</h2>
<form method="post">
    <input type="text" name="username" placeholder="Please enter username"/>
    <input type="password" name="password" placeholder="Please enter password"/>
    <button type="submit" name="save_registration">Create Account</button>
</form>

<?php
    if(isset($_POST['save_registration'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        //check if there's same registerd username
        $query_check = mysqli_query($con,"SELECT * FROM login WHERE username = '$username'");
        $result_check = mysqli_fetch_array($query_check);
        if($result_check>0){
            echo "There's profile with same username";
        }else{
            //insert into login table
            $query_insert = mysqli_query($con,"INSERT INTO login(username, password, role) VALUES ('$username','$password','seller')");
            $_SESSION['username'] = $username;
            header("location:Seller_Profile_Create.php");
        }

    }

?>