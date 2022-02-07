<?php include("Interface/header.php"); ?>
<?php include("Message_Notification.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-truck"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Shipping Management</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and manage shipping delivery method</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-4 pe-1">
            <div class="col-4 p-5 me-5 shadow">
                <h5>Please fill in below information to create a shipping method</h5>
                <form method="POST">
                    <div style="background-color: antiquewhite;" class="row mb-3 mt-4 pt-2 pb-2">
                        <div class="col"><input type="text" name="method" class="form-control" value="" placeholder="Enter method"/></div>
                    </div>
                    <div class="row mb-3">
                        <input type="text" class="form-control" name="price" placeholder="Enter price"/>
                    </div>
                    <div class="row mb-3">
                        <input type="number" class="form-control" name="days" placeholder="Enter No of days"/>
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
                        <th>Shipping ID</th>
                        <th>Shipping Method</th>
                        <th>Shipping Price</th>
                        <th>Day Arrival</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //display all table data
                        $query_showData = mysqli_query($con,"SELECT * FROM shipping");
                        while($result_showData = mysqli_fetch_array($query_showData)){

                        $shipping_id = $result_showData['Shipping_ID'];
                    ?>
                    <tr>
                        <td><?php echo $result_showData['Shipping_ID']; ?></td>
                        <td><?php echo $result_showData['Shipping_Method']; ?></td>
                        <td>RM<?php echo $result_showData['Shipping_Price']; ?></td>
                        <td><?php echo $result_showData['shipping_day']; ?></td>
                        <form method ="post">
                        <td>
                            <input type="hidden" name="DelShipping_id" value="<?php echo $shipping_id; ?>">
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
        $DelShipping_id = $_POST['DelShipping_id'];

        $query_deleteShipping = mysqli_query($con,"DELETE FROM shipping WHERE Shipping_ID = '$DelShipping_id'");
        
        $_SESSION['message'] = 'Shipping #'.$DelShipping_id.' have successfully deleted';
        echo '<script>window.location.href="Admin_ManageShipping.php?msg=success"</script>';
    }
?>
<?php
    if(isset($_POST['Save'])){
        $method = $_POST['method'];
        $price = $_POST['price'];
        $days = $_POST['days'];

        
        //insert into shipping table
        $query_createShipping = mysqli_query($con,"INSERT INTO shipping(Shipping_Method, Shipping_Price, shipping_day) VALUES ('$method','$price','$days')");

        //clear post request
        $_SESSION['message']="successfully created $method shipping";
        echo '<script>window.location.href="Admin_ManageShipping.php?msg=success"</script>';
        
    }
?>

<?php include("Interface/footer.php"); ?>
