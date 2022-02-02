
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
        <!-- Profile Account -->
        <div class="col-6 bg-white"></div>
        <div class="col-2"></div>
    </div>
<?php include("Interface/footer.php")?>