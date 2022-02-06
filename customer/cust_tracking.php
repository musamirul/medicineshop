
<?php include("Interface/header.php")?>
<?php
    $current_file_name = basename($_SERVER['PHP_SELF']); 
    $Cust_ID = $_SESSION['Cust_Id'];
?>

    <div class="row mt-5">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <?php include("Interface/sidebar.php") ?>
        </div>
        <!-- Profile Account -->
        <div class="col-6 bg-white">

        <div class="row">
            <div class="col-12 bg-white p-3 mb-5 bg-body rounded me-5">
                <div class="row p-3">
                    <div class="d-flex flex-row">
                        <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-mailbox2"></i></center></div>
                        <div class="text-start ms-3">
                            <span style="font-size: 23px;font-weight: bold;">Tracking</span> <br/>
                            <span style="font-size: 14px; color: grey;">View your tracking status</span>
                        </div>
                    </div>
                </div>
                <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div class="row pt-2 ps-5 pe-5 shadow ">
                    <table id="example" class="display center" style="width: 100%; text-align: center; font-size: 13px;">
                        <thead>
                            <tr>
                                <th>Tracking ID</th>
                                <th>Shipping Address</th>
                                <th>Total Amount</th>
                                <th>Prepared Date</th>
                                <th>Est Arrival Date</th>
                                <th>Tracking Channel</th>
                                <th>Current Track Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query_tracking = mysqli_query($con,"SELECT * FROM tracking WHERE FK_Tracking_Cust_ID = '$Cust_ID'");
                                while($result_tracking = mysqli_fetch_array($query_tracking)){

                                    $Tracking_ID = $result_tracking['Tracking_ID'];
                                    $query_cust = mysqli_query($con,"SELECT * FROM customer WHERE Cust_ID = '$Cust_ID'");
                                    $result_cust = mysqli_fetch_array($query_cust);

                                    $query_Ship = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID='$Cust_ID'");
                                    $result_Ship = mysqli_fetch_array($query_Ship);

                                    $Order_id = $result_tracking['FK_Tracking_Order_ID'];
                                    $query_order = mysqli_query($con,"SELECT * FROM orders WHERE FK_Order_Cust_ID='$Cust_ID' AND Order_ID='$Order_id'");
                                    $result_order = mysqli_fetch_array($query_order);
                            ?>
                            <tr>
                                <td><a data-bs-toggle="modal" data-bs-target="#TrackingView<?php echo $Tracking_ID ?>" href="">#<?php echo $result_tracking['Tracking_ID'] ?></a></td>
                                <td><?php echo $result_Ship['address'].', '.$result_Ship['zipcode'].' '.$result_Ship['city'].','.$result_Ship['state'].','.$result_Ship['country']; ?></td>
                                <td>RM<?php echo $result_order['Order_Amount'] ?></td>
                                <td><?php echo $result_tracking['Tracking_Date'].' ['.$result_tracking['Tracking_Time'].']'?></td>
                                <td><?php echo $result_tracking['Tracking_EstimateDate'].' ['.$result_tracking['Tracking_EstimateTime'].']'?></td>
                                <td><?php echo $result_tracking['Tracking_Channel'] ?></td>
                                <td><?php echo $result_tracking['Tracking_Status'] ?></td>
                            </tr>
                             <!-- View Product list -->
                            <div class="modal fade" id="TrackingView<?php echo $Tracking_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Shipment Tracking <strong> #<?php echo $Tracking_ID; ?></strong></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <span style="font-weight: bold;font-size: 14px;"><?php echo $result_cust['Cust_Name']?> </span> <span style="font-size: 14px;"><?php echo $result_cust['Cust_Phone']?></span><br/>
                                                <span style="font-size: 14px;"><?php echo $result_Ship['address'].', '.$result_Ship['zipcode'].' '.$result_Ship['city'].','.$result_Ship['state'].','.$result_Ship['country']; ?></span>
                                                <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                                                <div class="row">
                                                    <div class="col-2"></div>
                                                    <div class="col-8">
                                                        <?php 
                                                            $query_Shiptracking = mysqli_query($con,"SELECT * FROM tracking_shipment WHERE FK_Tracking_ID = '$Tracking_ID'");
                                                            while($result_ShipTracking = mysqli_fetch_array($query_Shiptracking)){
                                                        ?>
                                                        <div style="background-color: lavender;" class="d-flex flex-row bd-highlight mb-3">
                                                            <div class="p-2 bd-highlight"><?php echo $result_ShipTracking['Track_Ship_Date']?><br/><?php echo $result_ShipTracking['Track_Ship_Time']?></div>
                                                            <div class="p-2 bd-highlight"><i style="color: green;" class="bi bi-check-circle-fill"></i></div>
                                                            <div class="p-2 bd-highlight"><?php echo $result_ShipTracking['Track_Ship_Status']?></div>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                    <div class="col-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </form>
                                    </div>   
                                </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        </div>
        <div class="col-2"></div>
    </div>
<?php include("Interface/footer.php")?>