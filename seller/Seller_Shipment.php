<?php include("Interface/header.php"); ?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-truck"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Shipment Status</span> <br/>
                    <span style="font-size: 14px; color: grey;">View and update your shipment status</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <!-- Purchase table -->
            <div class="col">
                <div class="row bg-white mb-3 p-3">
                    <ul class="nav nav-pills d-flex justify-content-start">
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link active" aria-current="page" href="Seller_Shipment.php"><center>All</center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_unpaid.php"><center>Unpaid</center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_toShip.php"><center>To ship</center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_shipping.php"><center>Shipping</center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_completed.php"><center>Completed</center></a>
                        </li>
                        <li style="width: 150px;" class="nav-item">
                            <a class="nav-link text-reset" href="Seller_Shipment_cancel.php"><center>Cancellation</center></a>
                        </li>
                    </ul>
                </div>
            </div>
    </div>
</div>
<?php include("Interface/footer.php"); ?>