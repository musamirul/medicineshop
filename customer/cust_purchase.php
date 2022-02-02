
<?php include("Interface/header.php")?>
<?php
    $current_file_name = basename($_SERVER['PHP_SELF']); 
?>

    <div class="row mt-5">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <?php include("Interface/sidebar.php") ?>
        </div>
        <!-- Purchase table -->
        <div class="col-6">
            <div class="row bg-white mb-3 p-3">
                <ul class="nav nav-pills d-flex justify-content-evenly">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"  href="cust_purchase">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="purchase_topay.php">To Pay</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="purchase_toreceive.php">To Receive</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="purchase_completed.php">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-reset" href="purchase_cancel.php">Cancelled</a>
                    </li>
                </ul>
            </div>
            <div class="row bg-white p-3">

            </div>
        </div>
        <div class="col-2"></div>
    </div>
<?php include("Interface/footer.php")?>