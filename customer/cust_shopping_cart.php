
<?php include("Interface/header.php")?>

<div class="row mb-5 mt-5">
    <div class="col-2"></div>
    <div class="col-8">
        <div style="color: rgb(102, 101, 101);font-size: 14px;" class="row bg-white mt-3 mb-3 p-3 shadow-sm">
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

            
              

        $count = 0;
        while($count < $tempSize) {
            //Find Seller Name
            $sellerID = $FK_Seller_ID[$count];
            $query_seller = mysqli_query($con,"SELECT * FROM seller where Seller_ID ='$sellerID'");
            $result_seller = mysqli_fetch_array($query_seller);



        ?>
        <div class="row bg-white mt-3 p-3 shadow-sm">
        <span style="font-size: 13px; font-weight: bold;"><?php echo $result_seller['Seller_Name'] ?></span>
        <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            <?php 
                //Find cart_item data
                $query_cart_item_select = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Item_Seller_ID = '$sellerID' AND FK_Cart_ID = '$Cart_ID'");
                while($result_cart_item_select = mysqli_fetch_array($query_cart_item_select)){
                $product_ID = $result_cart_item_select['FK_Item_Product_ID'];

                //Find product name
                $query_product_name = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$product_ID'");
                $result_product_name = mysqli_fetch_array($query_product_name);
            ?>
            <div class="row">
                <div class="col-6"><img style="height: 6rem; width:6rem;" src="../seller/<?php echo $result_product_name['Product_Image']; ?>">
                <?php echo $result_product_name['Product_Name']; ?></div>
                <div class="col-2"><center>RM <?php echo $result_cart_item_select['Cart_Item_Amount'];?></center></div>
                <div class="col-1"><center><?php echo $result_cart_item_select['Cart_Item_Qty'] ?></center></div>
                <div class="col-2"><center><?php echo $result_cart_item_select['Cart_Item_Amount']*$result_cart_item_select['Cart_Item_Qty'];?></center></div>
                <div class="col-1"><center><button type="submit" class="btn btn-primary">delete</button></center></div>
                <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            </div>
            <?php }?>
        </div>
        <?php
            $count++;
        } 
        ?>
        
    </div>
    <div class="col-2"></div>
</div>

<div class="row mb-5"></div>
<div class="row mb-5"></div>
<!--
    1)check cart status pending -> get cart_ID
    2)cart_item -> FK_cart_item_cart_id;

-->
<?php
    $total_quantity = 0;
    $total_amount = 0;
    $query_total = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID = '$Cart_ID'");
    while($result_total = mysqli_fetch_array($query_total)){
        $total_quantity = $total_quantity+$result_total['Cart_Item_Qty'];
        $total_amount = $total_amount+($result_total['Cart_Item_Qty']*$result_total['Cart_Item_Amount']);
    }
?>
<div style="margin-bottom: 57px;" class="text-center fixed-bottom">
   <div class="container">
       <div style="height: 90px; background-color: white;" class="col-12 shadow pt-4 ps-3 pe-3">
            <div class="row">
                <div class="d-flex justify-content-end">
                    <div style="font-size: 19px;" class="p-2  text-end mt-2">total (<?php echo $total_quantity; ?> item):</div>
                    <div style="font-size: 30px;" class="p-2 text-danger">RM<?php echo $total_amount; ?></div>
                    <div class="p-2"></a><button class="btn btn-primary" name="checkout" type="submit"><a class="text-reset text-decoration-none" href="cust_checkout.php">Checkout</a></button></div>
                </div>
            </div>
       </div>
   </div>
</div>
<?php include("Interface/footer.php")?>