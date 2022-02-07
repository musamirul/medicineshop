<?php include("Interface/header.php"); ?>
<?php include("Message_Notification.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-person-fill"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Admin Management</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and manage Administrator</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-4 pe-1">
            <div class="col-4 p-5 me-5 shadow">
                <h5>Please fill in below information to create an administrator profile</h5>
                <form method="POST">
                    <div style="background-color: antiquewhite;" class="row mb-3 mt-4 pt-2 pb-2">
                        <div class="col"><input type="text" name="username" class="form-control" value="" placeholder="username"/></div>
                        <div class="col"><input type="text" name="password" class="form-control" value="" placeholder="password"/></div>
                    </div>
                    <div class="row mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Enter fullname"/>
                    </div>
                    <div class="row mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Enter Email"/>
                    </div>
                    <div class="row mb-3">
                        <input type="text" class="form-control" name="empNo" placeholder="Enter Employee Number"/>
                    </div>
                    <div class="row mb-3">
                        <select class="form-select" class="form-select form-select-sm" name="department">
                            <option value="administration">Administration</option>
                            <option value="it">Information Technology</option>                           
                            <option value="finance">Finance</option>                           
                            <option value="purchasing">purchasing</option>                           
                            <option value="marketing">marketing</option>                           
                            <option value="consultant">consultant</option>                           
                            <option value="pharmacist">pharmacist</option>                           
                        </select>
                    </div>
                    <div class="d-grid gap-1">
                        <button class="btn btn-primary" name="Save" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <div class="col-7">
            <table id="example" class="display center" style="width: 100%; text-align: center; font-size: 13px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Employee No</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //display all table data
                        $query_showData = mysqli_query($con,"SELECT * FROM administrator");
                        while($result_showData = mysqli_fetch_array($query_showData)){
                        $Admin_ID = $result_showData['Admin_ID'] 
                    ?>
                    <tr>
                        <td><?php echo $result_showData['Admin_Name']; ?></td>
                        <td><?php echo $result_showData['Admin_Email']; ?></td>
                        <td><?php echo $result_showData['Admin_Dept']; ?></td>
                        <td><?php echo $result_showData['Admin_EmpNo']; ?></td>
                        <form method ="post">
                        <td>
                            <select class="form-select form-select-sm mb-3" name="status">
                                <option value="Active" <?php if($result_showData['Admin_Status']=='active'){echo 'selected';} ?>>Active</option>
                                <option value="deactive" <?php if($result_showData['Admin_Status']=='deactive'){echo 'selected';}  ?>>Deactive</option>
                                <option value="suspend" <?php if($result_showData['Admin_Status']=='suspend'){echo 'selected';}  ?>>Suspend</option>
                            </select>
                        <td>
                            <input type="hidden" value="<?php echo $result_showData['Admin_ID']; ?>" name="Admin_ID">
                            <button class="btn btn-primary" name="saveDetail" type="submit">Update</button>
                        </td>
                        </form>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['saveDetail'])){
        $Admin_ID = $_POST['Admin_ID'];
        $status = $_POST['status'];

        $query_updateSeller = mysqli_query($con,"UPDATE administrator SET Admin_Status='$status' WHERE Admin_ID = '$Admin_ID'");
        
        $_SESSION['message'] = 'Profile have successfully '.$status;
        echo '<script>window.location.href="Admin_ManageAdmin.php"</script>';
    }
?>
<?php
    if(isset($_POST['Save'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $empNo = $_POST['empNo'];
        $department = $_POST['department'];

        //Check if username already exist
        $Query_Check = mysqli_query($con,"SELECT * FROM login WHERE username ='$username'");
        $Result = mysqli_fetch_array($Query_Check);

        if($Result>0){
            $_SESSION['messageErr'] = 'Username Exist, please create other username';
        }else{
            //If username not exist insert into 'login' db
            $Query_Submit = mysqli_query($con, "INSERT INTO login ( username, password, role) VALUES ('$username','$password','administrator')");

            //get login id
            $query_login = mysqli_query($con, "SELECT * FROM login WHERE username ='$username' AND role = 'administrator'");
            $result_login = mysqli_fetch_array($query_login);
            $login_id = $result_login['Login_ID'];

            //Insert into administrator table
            $Query_Submit_Profile = mysqli_query($con, "INSERT INTO administrator(Admin_Name, Admin_Email, Admin_EmpNo, Admin_Dept, Admin_Status, FK_Admin_Login_ID) 
            VALUES ('$name','$email','$empNo','$department','active','$login_id')");

            $_SESSION['message'] = 'Profile '.$name.' have successfully created';
            echo '<script>window.location.href="Admin_ManageAdmin.php"</script>';
            exit();
                
        }
        
    }
?>

<?php include("Interface/footer.php"); ?>