<?php include("Interface/header.php"); ?>
<?php 
  $admin_id = $_SESSION['Admin_Id'];
  $query_healthInfo = mysqli_query($con,"SELECT count(*) FROM healthinfo");
  $result_healthInfo = mysqli_fetch_array($query_healthInfo);
  $totalhealthInfo = $result_healthInfo[0];

$query_adminTotal = mysqli_query($con, "SELECT count(*) FROM administrator");
$result_adminTotal = mysqli_fetch_array($query_adminTotal);
$totaladmin = $result_adminTotal[0];
$query_sellerTotal = mysqli_query($con, "SELECT count(*) FROM seller");
$result_sellerTotal = mysqli_fetch_array($query_sellerTotal);
$totalseller = $result_sellerTotal[0];
$query_customerTotal = mysqli_query($con, "SELECT count(*) FROM customer");
$result_customerTotal = mysqli_fetch_array($query_customerTotal);
$totalcustomer = $result_customerTotal[0];

$query_helpTotal = mysqli_query($con,"SELECT count(*) FROM help");
$result_helpTotal = mysqli_fetch_array($query_helpTotal);
$helpTotal = $result_helpTotal[0];

$query_shipmentMethod = mysqli_query($con,"SELECT count(*) FROM shipping");
$result_shipmentMehtod = mysqli_fetch_array($query_shipmentMethod);
$shipmentMethod = $result_shipmentMehtod[0];

?>
<div class="row">
    <div class="col-12 p-3 mb-5 bg-body  rounded me-5 shadow-sm">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Dashboard</span> <br/>
                    <span style="font-size: 14px; color: grey;">Ecommerce Dashboard</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <div class="col">
              
              <div class="card text-dark bg-info mb-3  opacity-75" style="max-width: 18rem;">
                <a class="text-decoration-none" href="Admin_HealthInfo-manage.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div style="color:white; font-size:13px; font-weight:600">HEALTH ARTICLE</div>
                          <span style="color:white; font-size:20px; font-weight:600"><?php echo  $totalhealthInfo; ?></span>
                        </div>
                        <div class="col pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-basket3-fill p-2 text-info"></i>
                          </div>
                        </div>
                    </div>
                </div>
                </a>
              </div>
            </div>

            <div class="col">
              <div class="card text-dark bg-success mb-3  opacity-75" style="max-width: 18rem;">
                <a class="text-decoration-none" href="Admin_ManageAdmin.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                          <div style="color:white; font-size:13px; font-weight:600">TOTAL USERS</div>
                          <span style="color:white; font-size:14px; ">Admin: <?php echo $totaladmin; ?> Seller: <?php echo $totalseller; ?> Cust: <?php echo $totalcustomer; ?></span>
                        </div>
                        <div class="col-4 pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-currency-dollar p-2 text-success"></i>
                          </div>
                        </div>
                    </div>
                </div>
                </a>
              </div>
            </div>

            <div class="col">
              <div class="card text-dark bg-warning mb-3 opacity-75" style="max-width: 18rem;">
                <a class="text-decoration-none" href="Admin_HelpAssistant.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div style="color:white; font-size:13px; font-weight:600">HELP ASSISTANT</div>
                          <span style="color:white; font-size:20px; font-weight:600"><?php echo $helpTotal; ?></span>
                        </div>
                        <div class="col pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-plus-circle-fill p-2 text-warning"></i>
                          </div>
                        </div>
                    </div>
                </div>
                </a>
              </div>
            </div>

            <div class="col">
              <div class="card text-dark bg-primary mb-3 opacity-75" style="max-width: 18rem;">
                <a class="text-decoration-none" href="Admin_ManageShipping.php">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div style="color:white; font-size:13px; font-weight:600">Shipment Method</div>
                          <span style="color:white; font-size:20px; font-weight:600"><?php echo $shipmentMethod; ?></span>
                        </div>
                        <div class="col pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-people-fill p-2 text-primary"></i>
                          </div>
                        </div>
                    </div>
                </div>
                </a>
              </div>
            </div>
            
        </div>
        

          
        </div>
    </div>
</div>

<?php include("Interface/footer.php"); ?>