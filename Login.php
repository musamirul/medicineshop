<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Interface/style/bootstrap/css/bootstrap.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="Interface/style/DataTables/css/jquery.dataTables.css">
    <link href="Interface/style/summernote/summernote-lite.css" rel="stylesheet">

  </head>
  <body>

<header>
    <?php
    session_start();
    include("includes/config.php");
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>
</header>
      <main>
        <div class="container-fluid">
            <div class="row m-5 shadow bg-body rounded" style="height: 600px;">
                <div class="col-6">
                    <img class="img-fluid" width="100%" height="100%" src="Interface/style/image/phn.png">
                </div>
                <div class="col-6">
                    
                    <div class="row mt-4">
                        <div class="d-flex justify-content-center">
                            <div class="p-2 bd-highlight"><img src="Interface/style/image/logo.png" style="height: 30px;"></div>
                            <div class="pe-2 pt-2 pb-2 bd-highlight" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-weight: bold; font-size: 20px;">OnlineMedicineShopping</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                            <div class="col-6">
                            <center><h2 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">Sign in</h2></center>
                            <center><span style="color: grey; font-size: 13px;">Free access to our shopping system</span></center>
                            
                            <!--NAV bar for home and registration-->
                            <ul class="nav nav-pills nav-pills nav-justified mb-3 mt-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Sign In</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Registration</button>
                                </li>
                              </ul>
                              <div class="tab-content" id="pills-tabContent">
                                  <!--Nav bar Sign In-->
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <form method="POST">
                                        <div class="row mb-3 mt-4">
                                            <input type="text" class="form-control" name="username" placeholder="Please enter your username"/>
                                        </div>
                                        <div class="row mb-3">
                                            <input type="password" class="form-control" name="password" placeholder="Please enter your password"/>
                                        </div>
                                        <div class="d-grid gap-1">
                                            <button class="btn btn-primary" name="login" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="d-flex flex-row bd-highlight mt-3 justify-content-between">
                                            <div class="p-2 bd-highlight">Remember me</div>
                                            <div class="p-2 bd-highlight"><a class="text-decoration-none" href="#">Forgot password?</a></div>
                                        </div>
                                    </div>
                                </div>
                                    <!--Nav bar Registration-->
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                    <form method="POST">
                                        <div class="row mb-3 mt-4">
                                            <input type="text" class="form-control" name="usernameAcc" placeholder="Please enter your username"/>
                                        </div>
                                        <div class="row mb-3">
                                            <input type="password" class="form-control" name="passwordAcc" placeholder="Please enter your password"/>
                                        </div>
                                        <div class="d-grid gap-1">
                                            <button class="btn btn-primary" name="CreateAccountBtn" type="submit">Create Account</button>
                                        </div>
                                    </form>
                                </div>
                              </div>
                            </div>
                            
                        <div class="col-3"></div>
                    </div>

                </div>
            </div>

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
                echo '<script>window.location.href="homepage.php"</script>';
                //header("location:http://localhost/medicineshop/homepage.php");

            }else{
                echo 'false';
                $_SESSION['Cust_Id'] = "";
                //go to profile page to update user account
                echo '<script>window.location.href="customer/profile.php"</script>';
                //header("location:http://localhost/medicineshop/customer/profile.php");
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
                echo '<script>window.location.href="seller/Seller_Dashboard.php"</script>';
                //header("location:seller/Seller_Dashboard.php");
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

<?php
if(isset($_POST['CreateAccountBtn'])){
    $usernameAcc = $_POST['usernameAcc'];
    $passwordAcc = $_POST['passwordAcc'];
    
    //Check if username already exist
    $Query_Check = mysqli_query($con,"SELECT * FROM login WHERE username ='$usernameAcc'");
    $Result = mysqli_fetch_array($Query_Check);

    if($Result>0){
        echo 'found';
    }else{
        //If username not exist insert into 'login' db
        $Query_Submit = mysqli_query($con, "INSERT INTO login ( username, password, role) VALUES ('$usernameAcc','$passwordAcc','customer')");
        $_SESSION['username'] = $_POST['usernameAcc'];
        echo '<script>window.location.href="customer/create_profile.php"</script>';
        exit();
            
    }
    
}
?>

<?php include("Interface/footer.php");