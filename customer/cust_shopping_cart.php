<?php include("Interface/header.php")?>
<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['id']==""){
        header("location:http://localhost/medicineshop/login.php");
    }
    $_SESSION['id'];
    $_SESSION['username'];
    $_SESSION['role'];
    $_SESSION['Cust_Id'];
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-8">
        <div style="color: rgb(102, 101, 101);font-size: 14px;" class="row bg-white mt-3 mb-3 p-3">
            <div class="col-6">Product</div>
            <div class="col-2"><center>Unit Price</center></div>
            <div class="col-1"><center>Quantity</center></div>
            <div class="col-2"><center>Total Price</center></div>
            <div class="col-1"><center>Actions</center></div>
        </div>
        <!--
            1) Find cart_id in cart  = pending

            2) loop div based on FK_Item_Seller_ID on cart_item

            3) show cart_item that only contain cart_id = pending

        -->
        <?php
            //Find cart_id in cart = pending
            $Cart_Cust_ID = $_SESSION['Cust_Id'];
            $query_cart_CartID = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$Cart_Cust_ID' AND Cart_Status ='pending'");
            $query_cart_CartID_result = mysqli_fetch_array($query_cart_CartID);
            $Cart_ID = $query_cart_CartID_result['Cart_ID'];

            $arr = array();
            $tempSize = 0;
            $temp_CartID = "";
            //loop div based on FK_ITEM_Seller_ID on cart_item
            $query_cart_item = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Cart_ID'");
            while($result_cart_item = mysqli_fetch_array($query_cart_item)){

                if($result_cart_item['FK_Item_Seller_ID'] != $temp_CartID){
                    $temp_CartID = $result_cart_item['FK_Item_Seller_ID'];
                    $tempSize++;
                }
            }
        ?>
        <div class="row bg-white p-3">
        <span style="font-size: 13px; font-weight: bold;">Seller</span>
        <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            <div class="col-6">Product</div>
            <div class="col-2"><center>Unit Price</center></div>
            <div class="col-1"><center>Quantity</center></div>
            <div class="col-2"><center>Total Price</center></div>
            <div class="col-1"><center>Actions</center></div>
        </div>
    </div>
    <div class="col-2"></div>
</div>

<?php include("Interface/footer.php")?>