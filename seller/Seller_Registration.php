<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Interface/style/bootstrap/css/bootstrap.min.css" media="screen">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="Interface/style/css/style1.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="Interface/style/DataTables/css/jquery.dataTables.css">
    <link href="Interface/style/summernote/summernote-lite.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="Interface/style/DataTables/dataTables.bootstrap5.min.css">-->
  </head>
  <body>

<?php
    session_start();
    include("../includes/config.php");
    if(isset($_SESSION['message'])){
        $_SESSION['message'];
        echo "<div class='alert alert-success mt-3 ms-5' role='alert' style='position : absolute; width:500px'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
        . $_SESSION['message'] .
        "</div>";

        unset($_SESSION['message']);
    }   
?>

        <div class="container-fluid">
            <div class="row m-5 shadow bg-body rounded" style="height: 700px; background-image: url('Interface/style/image/phn2.png'); background-repeat: no-repeat;background-size: cover;">
                <div class="col-3">
                </div>
                <div style="height: 70%;" class="col-6 mt-5 bg-white shadow-lg bg-body rounded-3">
                    <div class="row pt-5">
                        <div class="d-flex justify-content-center">
                            <div class="p-2 bd-highlight"><img src="Interface/style/image/logo.png" style="height: 30px;"></div>
                            <div class="pe-2 pt-2 pb-2 bd-highlight" style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;font-weight: bold; font-size: 20px;">OnlineMedicineShopping</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                            <div class="col-6">
                            <center><h2 style="font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">New Seller Registration</h2></center>
                            <center><span style="color: grey; font-size: 13px;">Free access to our shopping system</span></center>
                            
                            <!--Nav bar Sign In-->
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <form method="POST">
                                <div class="row mb-3 mt-4">
                                    <input type="text" class="form-control" name="username" placeholder="Please enter your username" required/>
                                </div>
                                <div class="row mb-3">
                                    <input type="password" class="form-control" name="password" placeholder="Please enter your password" required/>
                                </div>
                                <div class="d-grid gap-1">
                                    <button class="btn btn-primary" name="save_registration" type="submit">Create Account</button>
                                </div>
                            </form>
                        <div class="col-3"></div>
                    </div>
                </div>
                <div class="col-3">

                </div>
            </div>
        </div>
<?php
    if(isset($_POST['save_registration'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        //check if there's same registerd username
        $query_check = mysqli_query($con,"SELECT * FROM login WHERE username = '$username'");
        $result_check = mysqli_fetch_array($query_check);
        if($result_check>0){
            $_SESSION['message'] = "There's profile with same username";
            echo '<script>window.location.href="Seller_Registration.php"</script>';
        }else{
            //insert into login table
            $query_insert = mysqli_query($con,"INSERT INTO login(username, password, role) VALUES ('$username','$password','seller')");
            $_SESSION['username'] = $username;
            echo '<script>window.location.href="Seller_Profile_Create.php"</script>';
        exit();
        }

    }

?>
<?php include("Interface/footer.php");