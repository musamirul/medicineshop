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
<h2>Create an admin Account</h2>
<form method="post">
    <input type="text" name="username" placeholder="Enter username"/><br/>
    <input type="password" name="password" placeholder="Enter password"/><br/>
    <input type="text" name="email" placeholder="Enter email"/><br/>
    <input type="text" name="empNo" placeholder="Enter Employee No"/><br/>
    <select name="department">
                <option value="it" selected>Information Technology</option>
                <option value="finance">Finance</option>
                <option value="administration">administration</option>
                <option value="marketing">marketing</option>
    </select><br/>
    <button type="submit" name="createAdmin">Create Admin</button>
</form>
<?php
    if(isset($_POST['createAdmin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $empNo = $_POST['empNo'];
        $department = $_POST['department'];
        
        //insert into login table
        $query_createAdmin = mysqli_query($con,"INSERT INTO login(username, password, role) VALUES ('$username','$password','administrator')");

        //get login ID by using username
        $query_checkUsername = mysqli_query($con,"SELECT * FROM login WHERE username = '$username'");
        $result_checkUsername = mysqli_fetch_array($query_checkUsername);
        $loginId = $result_checkUsername['Login_ID'];

        //insert into administrator table
        $query_AdminAcc = mysqli_query($con,"INSERT INTO administrator(Admin_Email, Admin_EmpNo, Admin_Dept, FK_Admin_Login_ID)
        VALUES ('$email','$empNo','$department','$loginId')");
        //clear post request
        $_SESSION['message']="successfully created account $username";
        header('Location:Admin_Registration.php?msg=success');
    }
?>