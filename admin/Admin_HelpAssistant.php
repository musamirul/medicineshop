<?php include("Interface/header.php"); ?>
<?php include("Message_Notification.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-question-square"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Help Assistant</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and manage help assistant</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-4 pe-1">
            <div class="col-4 p-5 me-5 shadow">
                <h5>Please fill in below information to create a new help method</h5>
                <form method="POST">
                    <div style="background-color: antiquewhite;" class="row mb-3 mt-4 pt-2 pb-2 ps-2 pe-2">
                        <select class="form-select" name="category">
                            <option selected>Open this select menu</option>
                            <option value="general">General</option>
                            <option value="online_consultation">Online Consultation</option>
                            <option value="online_medicine">Online Medicine</option>
                            <option value="payment_option">Payment Option</option>
                            <option value="corporate">Corporate</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <input type="text" class="form-control" name="title" placeholder="Enter Title"/>
                    </div>
                    <div class="row mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" name="description" placeholder="Leave description here" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Description</label>
                        </div>
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
                        <th>ID</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Desc</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //display all table data
                        $query_showData = mysqli_query($con,"SELECT * FROM help");
                        while($result_showData = mysqli_fetch_array($query_showData)){

                        $help_id = $result_showData['Help_ID'];
                    ?>
                    <tr>
                        <td><?php echo $result_showData['Help_ID']; ?></td>
                        <td><?php echo $result_showData['Help_Category']; ?></td>
                        <td><?php echo $result_showData['Help_Title']; ?></td>
                        <td><?php echo substr($result_showData['Help_Desc'],0,40) ?>...</td>
                        <td><?php echo $result_showData['Help_Date']; ?></td>
                        <form method ="post">
                        <td>
                            <input type="hidden" name="DelHelp_id" value="<?php echo $help_id; ?>">
                            <button class="btn btn-primary" name="delete" type="submit">Delete</button>
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
    if(isset($_POST['delete'])){
        $DelHelp_id = $_POST['DelHelp_id'];

        $query_deleteHelp = mysqli_query($con,"DELETE FROM help WHERE Help_ID = '$DelHelp_id'");
        
        $_SESSION['message'] = 'Help #'.$DelHelp_id.' have successfully deleted';
        echo '<script>window.location.href="Admin_HelpAssistant.php?msg=success"</script>';
    }
?>
<?php
    if(isset($_POST['Save'])){
        $category = $_POST['category'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $adminID = $_SESSION['Admin_Id'];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Y-m-d");

        
        //insert into shipping table
        $query_createShipping = mysqli_query($con,"INSERT INTO help(Help_Title, Help_Category, Help_Desc, Help_Date, FK_Help_Admin_ID) 
        VALUES ('$title','$category','$description','$date','$adminID')");

        //clear post request
        $_SESSION['message']="successfully created $title";
        echo '<script>window.location.href="Admin_HelpAssistant.php?msg=success"</script>';
        
    }
?>

<?php include("Interface/footer.php"); ?>
