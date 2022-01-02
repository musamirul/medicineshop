<?php
    session_start();
    include("includes/config.php");
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>
<h2>Login page</h2>
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
        //ADMINISTRATOR
        if($result['role']=='administrator'){
            //go to admin page
            $_SESSION['id'] = $result['Login_ID'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['role'] = $result['role'];
            echo 'administrator';
        
        //CUSTOMER
        }elseif($result['role']=='customer'){
            //go to user page
            //if fk_cust_id dont have login_id - go to profile page
            $login_id = $result['Login_ID'];
            $Query_Check_ID = mysqli_query($con,"SELECT * FROM customer WHERE FK_Cust_Login_ID = '$login_id'");
            $result_check = mysqli_fetch_array($Query_Check_ID);
            
            if($result_check>0){
                //go to homepage
                $_SESSION['id'] = $result['Login_ID'];
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['role'] = $result['role'];
                $_SESSION['Cust_Id'] = $result_check['Cust_ID'];
                header("location:http://localhost/medicineshop/homepage.php");

            }else{
                echo 'false';
                $_SESSION['Cust_Id'] = "";
                //go to profile page to update user account
                header("location:http://localhost/medicineshop/customer/profile.php");
                exit();
            }
        
        //SELLER
        }else {
            $login_id = $result['Login_ID'];
            //check if account have approve
            $query_checkApproval = mysqli_query($con,"SELECT * FROM seller WHERE FK_Seller_Login_ID = '$login_id'");
            $result_checkApproval = mysqli_fetch_array($query_checkApproval);
            if($result_checkApproval['Seller_Registration_Status']=="Active"){

                $_SESSION['id'] = $result['Login_ID'];
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['role'] = $result['role'];
                $_SESSION['RegStatus'] = $result_checkApproval['Seller_Registration_Status'];
                $_SESSION['Seller_Id'] = $result_checkApproval['Seller_ID'];
                //go to seller page
                header("location:seller/Seller_Dashboard.php");
                exit();

            }else{
                echo "Account is inactive";
            }
            
        }
    }else{
        echo 'false';
    }
}
?>