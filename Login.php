<?php
    session_start();
    include("includes/config.php");
?>
<form method="POST">
    <input type="text" name="username" placeholder="Please enter your username"/>
    <input type="password" name="password" placeholder="Please enter your password"/>
    <button name="login" type="submit">LOGIN</button>
</form>
<?php
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    //check username and password
    $Query_Check = mysqli_query($con,"SELECT * FROM login WHERE (username ='$username' AND password = '$password')");
    $result = mysqli_fetch_array($Query_Check);
    
    if($result>0){
        if($result['role']=='administrator'){
            //go to admin page
            echo 'administrator';
            
        }elseif($result['role']=='customer'){
            //go to user page
            $_SESSION['id'] = $result['Login_ID'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['role'] = $result['role'];
            
            //if fk_cust_id dont have login_id - go to profile page
            $login_id = $result['Login_ID'];
            $Query_Check_ID = mysqli_query($con,"SELECT * FROM customer WHERE FK_Cust_Login_ID = '$login_id'");
            $result_check = mysqli_fetch_array($Query_Check_ID);
            
            if($result_check>0){
                //go to homepage
                echo 'true';
                
                header("location:http://localhost/medicineshop/homepage.php");

            }else{
                echo 'false';
                //go to profile page to update user account
                header("location:http://localhost/medicineshop/customer/profile.php");
                exit();
            }
            
        }else {
            //go to seller page
            echo 'seller';
        }
    }else{
        echo 'false';
    }
}
?>