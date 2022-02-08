<?php include("Interface/header.php"); ?>
<?php include("Message_Notification.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi bi-journals"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Article Management</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and manage health information article</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <table id="example" class="display center" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Article ID</th>
                        <th>Title</th>
                        <th>Publish Date</th>
                        <th>Publish Time</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //display all table data
                        $query_showData = mysqli_query($con,"SELECT * FROM healthinfo");
                        while($result_showData = mysqli_fetch_array($query_showData)){
                        $Health_ID = $result_showData['HealthInfo_ID'] 
                    ?>
                    <tr>
                        <td><?php echo $result_showData['HealthInfo_ID']; ?></td>
                        <td><?php echo $result_showData['HealthInfo_Title']; ?></td>
                        <td><?php echo $result_showData['HealthInfo_Date']; ?></td>
                        <td><?php echo $result_showData['HealthInfo_Time']; ?></td>
                        <td><?php echo $result_showData['HealthInfo_Author']; ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#HealthModal<?php echo $Health_ID ?>">Edit</button>
                        </td>
                    </tr>
                        <!-- View Seller -->
                        <div class="modal fade" id="HealthModal<?php echo $Health_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit article <strong>#<?php echo $result_showData['HealthInfo_Title']; ?></strong></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form method="POST">
                                    <div class="row mb-3 mt-4">
                                        <input type="text" class="form-control" name="title" value ="<?php echo $result_showData['HealthInfo_Title']; ?>" required/>
                                    </div>
                                    <div class="row mb-3">
                                        <input type="text" class="form-control" name="author" value ="<?php echo $result_showData['HealthInfo_Author']; ?>" required/>
                                    </div>
                                    <div class="row mb-3">
                                        <input type="text" class="form-control" name="tags" value ="<?php echo $result_showData['HealthInfo_Tags']; ?>" required/>    
                                    </div>
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $result_showData['HealthInfo_ID']; ?>" name="health_ID">
                                    <button class="btn btn-primary" name="saveDetail" type="submit">Save</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                                </form>   
                            </div>
                            </div>
                        </div>
                        <!-- End Seller -->
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['saveDetail'])){
        $title = $_POST['title'];
        $author = $_POST['author'];
        $tags = $_POST['tags'];
        $health_id = $_POST['health_ID'];

        $query_updateHealthInfo = mysqli_query($con,"UPDATE healthinfo SET HealthInfo_Title='$title',HealthInfo_Tags='$tags',HealthInfo_Author='$author'
        WHERE HealthInfo_ID = '$health_id'");
        $_SESSION['message'] = 'successfully update article';
        echo '<script>window.location.href="Admin_HealthInfo-manage.php"</script>';
    }
?>

<?php include("Interface/footer.php"); ?>