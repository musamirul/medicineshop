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

<?php
//get customer name and phone number
$custID = $_SESSION['Cust_Id'];
$query_customerDetail = mysqli_query($con, "SELECT * FROM customer WHERE Cust_ID = '$custID'");
$result_customerDetail = mysqli_fetch_array($query_customerDetail);

//get customer delivery address
$query_shippingAddress = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID = '$custID'");
$result_shippingAddress = mysqli_fetch_array($query_shippingAddress);
$address = $result_shippingAddress['address'] .", ". $result_shippingAddress['city'] .", ". $result_shippingAddress['state'] .", ". $result_shippingAddress['zipcode'] .", ". $result_shippingAddress['country'];

//Find cart_id in cart = pending
$Cart_Cust_ID = $_SESSION['Cust_Id'];
$query_cart_CartID = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$Cart_Cust_ID' AND Cart_Status ='pending'");
$query_cart_CartID_result = mysqli_fetch_array($query_cart_CartID);
$Cart_ID = $query_cart_CartID_result['Cart_ID'];


$tempSize = 0;
$FK_Seller_ID = array();
$temp_CartID = "";
//loop div based on FK_ITEM_Seller_ID on cart_item
$query_cart_item = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Cart_ID'");
while($result_cart_item = mysqli_fetch_array($query_cart_item)){

    if($result_cart_item['FK_Item_Seller_ID'] != $temp_CartID){
        $temp_CartID = $result_cart_item['FK_Item_Seller_ID'];
        $FK_Seller_ID[] = $result_cart_item['FK_Item_Seller_ID'];
        $tempSize++;
    }
}
$tempSize;
$temp_CartID;

?>

<div class="row mb-5">
    <div class="col-2"></div>
    <div class="col-8">
        <div class="row bg-white mt-3 mb-3 p-3 shadow-sm">
            <div class="row">
                <span><i class="bi bi-geo-alt-fill"></i> Delivery Address</span>
            </div>
            <div class="row p-2 ms-3">
                <div style="font-weight: bold;" class="col-2 text-start"><?php echo $result_customerDetail['Cust_Name'] ?></div>
                <div style="font-weight: bold;" class="col-2 text-start"><?php echo $result_customerDetail['Cust_Phone'] ?></div>
                <div class="col-7"><?php echo $address; ?></div>
            </div>
        </div>
        <div class="row bg-white mt-3 pt-3 ps-3 pe-3 shadow-sm">
            <div style="font-size: 17px;" class="col-7">Products Ordered</div>
            <div style="font-size: 14px;" class="col-2"><center>Unit Price</center></div>
            <div style="font-size: 14px;" class="col-1"><center>Amount</center></div>
            <div style="font-size: 14px;" class="col-2 text-end">Item Subtotal</div> 
        </div>
        <?php
            $count = 0;
            while($count < $tempSize) {

            //Find Seller Name
            $sellerID = $FK_Seller_ID[$count];
            $query_seller = mysqli_query($con,"SELECT * FROM seller where Seller_ID ='$sellerID'");
            $result_seller = mysqli_fetch_array($query_seller);

        ?>
            <div class="row bg-white p-3 shadow-sm"><span><?php echo $result_seller['Seller_Name']?></span></div>
            <?php
                //Find cart_item data
                $query_cart_item_select = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Item_Seller_ID = '$sellerID'");
                while($result_cart_item_select = mysqli_fetch_array($query_cart_item_select)){
                $product_ID = $result_cart_item_select['FK_Item_Product_ID'];

                //Find product name
                $query_product_name = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$product_ID'");
                $result_product_name = mysqli_fetch_array($query_product_name);
            ?>
                <div class="row bg-white p-3 shadow-sm">
                <!--Product List-->
                    <div class="col-7"><img style="height: 3rem; width:3rem;" src="../seller/<?php echo $result_product_name['Product_Image']; ?>">
                    <?php echo $result_product_name['Product_Name']; ?></div>
                    <div class="col-2"><center>RM <?php echo $result_cart_item_select['Cart_Item_Amount'];?></center></div>
                    <div class="col-1"><center><?php echo $result_cart_item_select['Cart_Item_Qty'] ?></center></div>
                    <div class="col-2 text-end">RM <?php echo $result_cart_item_select['Cart_Item_Amount']*$result_cart_item_select['Cart_Item_Qty'];?></div>
                </div>
            <?php
                }
            ?>
            <div style="background-color: rgb(235, 251, 255);" class="row p-3 shadow-sm">
            <!--Delivery option-->
                <div class="col-6"></div>
                <div class="col-2 text-end">Delivery</div>
                <div class="col-2 text-end">Change</div>
                <div class="col-2 text-end">RM4.50</div>
            </div>
            <div style="background-color: rgb(235, 251, 255);" class="row p-3 mb-3 shadow-sm">
            <!--Total Payment order-->
            <?php
                //Subtotal & subAmount
                $total_quantity = 0;
                $total_amount = 0;

                $query_total = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Cart_ID' AND FK_Item_Seller_ID = '$sellerID'");
                while($result_total = mysqli_fetch_array($query_total)){
                    $total_quantity = $total_quantity+$result_total['Cart_Item_Qty'];
                    $total_amount = $total_amount+($result_total['Cart_Item_Qty']*$result_total['Cart_Item_Amount']);
                }
            ?>
                <div class="col-9"></div>
                <div style="font-size: 14px;" class="col-2 pt-1 text-end text-black-50">Order Total (<?php echo $total_quantity?> Item):</div>
                <div style="font-size: 20px; font-weight: bold;" class="col-1 text-end text-danger">RM<?php echo $total_amount ?></div>
            </div>
        <?php
            $count++;
            } 
        ?>


    </div>
    <div class="col-2"></div>
</div>

<?php include("Interface/footer.php")?>