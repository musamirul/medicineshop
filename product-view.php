<?php
session_start();

include("includes/config.php");
include("Interface/header.php");
$_SESSION['id'];
$_SESSION['username'];
$_SESSION['role'];
$_SESSION['Cust_Id'];

//get id from link
$id = intval($_GET['prodId']);
?>

<?php
//Select product 
$product_query = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$id'");
$product_result= mysqli_fetch_array($product_query);
$FK_Seller_ID = $product_result['FK_Product_Seller_ID'];
?>

<?php
//Select seller
$seller_query = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID = '$FK_Seller_ID'");
$seller_result = mysqli_fetch_array($seller_query);

?>

<?php
//Count total product
$count_query = mysqli_query($con,"SELECT count('Product_ID') AS total_id FROM product WHERE FK_Product_Seller_ID = '$FK_Seller_ID'");
$count_result = mysqli_fetch_object($count_query);

?>
<div class="container bg-white shadow bg-body rounded">
    <form method="post">
    <div class="row">
        <div class="col-5 mt-3 mb-4">
            <center><img class="img-fluid" style="height: 25rem;" src="seller/<?php echo $product_result['Product_Image']; ?>"></center>
        </div>
        <div class="col-7 mt-3 mb-5">
            <div class="col">
                <h5><?php echo $product_result['Product_Name'] ?></h5>
            </div>
            <div class="col p-2 bg-light">
                <span class="text-danger fs-4"><b>RM<?php echo $product_result['Product_SellingPrice'] ?></b></span>
            </div>
            <div class="col">
                <span>Shipping</span>
            </div>
            <div class="col">
                <div class="row">
                    <label class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-2">
                        <input type="number" name="quantity" class="form-control" placeholder="Number">
                    </div>
                    <label class="col-sm-3 col-form-label"><?php echo $product_result['Product_Qty'] ?> Pieces Available</label>
                </div>
            </div>
            <div class="col mt-3">
                <button type="submit" name="AddToCart" class="btn btn-secondary">Add To Cart</button>
                <button type="submit" class="btn btn-dark">Buy Now</button>
            </div>
        </div>
    </div>
    </form>
</div>

<div class="container mt-3 bg-white shadow bg-body rounded">
    <div class="row">
        <div class="col-1 m-3">
            <img src="" class="rounded-circle img-thumbnail"/>
        </div>
        <div class="col-3 m-3">
            <div class="d-flex flex-column bd-highlight">
                <div class="p-2 bd-highlight"><?php echo $seller_result['Seller_Name']; ?></div>
                <div class="p-2 bd-highlight"><button>View Shop</button></div>
            </div>
        </div>
        <div class="col-7 m-3">
            <div class="d-flex flex-row bd-highlight mb-3">
                <div class="p-2 bd-highlight"><span style="font-size: 13px; color: grey;" class="fw-light">Products</span> <span style="color: red; margin-left: 10px; font-size: 14px;"><?php echo $count_result->total_id; ?></span></div>
                <div class="p-2 bd-highlight"><span style="font-size: 13px; color: grey;" class="fw-light">Contacts</span> <span style="color: red; margin-left: 10px; font-size: 14px;"><?php echo $seller_result['Seller_Phone'] ?></span></div>
                <div class="p-2 bd-highlight"></div>
              </div>
              <div class="d-flex flex-row bd-highlight">
                <div class="p-2 bd-highlight"><span style="font-size: 13px; color: grey;" class="fw-light">Joined</span> <span style="color: red; margin-left: 10px; font-size: 14px;">26 months ago</span></div>
                <div class="p-2 bd-highlight"></div>
                <div class="p-2 bd-highlight"></div>
              </div>
        </div>
    </div>
</div>

<div class="container mt-3 bg-white shadow bg-body rounded">
    <div class="row">
        <div class="col m-3">
            <div class="col p-2 bg-light">
                <span style="font-size: 18px;">Product Specification</span>
            </div>
        </div>
        <div class="row ">
            <div class="col ms-4 mb-3 pe-5" style="word-wrap: break-word;">
                <?php echo $product_result['Product_Spec'] ?>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3 bg-white shadow bg-body rounded mb-5">
    <div class="row">
        <div class="col m-3">
            <div class="col p-2 bg-light">
                <span style="font-size: 18px;">Product Description</span>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col ms-4 mb-3 pe-5" style="word-wrap: break-word;">
            <?php echo $product_result['Product_Desc'] ?>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['AddToCart'])){
        $quantity = $_POST['quantity'];
        $product_ID = $product_result['Product_ID'];
        $product_Price = $product_result['Product_SellingPrice'];
        $seller_ID = $product_result['FK_Product_Seller_ID'];
        $cust_ID = $_SESSION['Cust_Id'];
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $timeStamp = date("Y-m-d h:i:sa");



        $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID'");
        $cart_check_result = mysqli_fetch_array($cart_check_query);
        //New profile Account, never have cart
        if($cart_check_result['FK_Cart_Cust_ID']==""){
            //create cart
           
            $cart_create_query = mysqli_query($con,"INSERT INTO cart(Cart_TimeStamp, Cart_Status, FK_Cart_Cust_ID)
            VALUES ('$timeStamp','pending','$cust_ID')");

            //check newly created cart and get cart ID
            $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
            $cart_check_result = mysqli_fetch_array($cart_check_query);
            $cart_ID = $cart_check_result['Cart_ID'];

            //add item into cart_item
            $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID) 
            VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID')");


        //Pending Cart
        }elseif($cart_check_result['FK_Cart_Cust_ID']=="$cust_ID" && $cart_check_result['Cart_Status']=="pending"){
            //check pending cart and get cart ID
            $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
            $cart_check_result = mysqli_fetch_array($cart_check_query);
            $cart_ID = $cart_check_result['Cart_ID'];

            //add item into cart_item
            $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID) 
            VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID')");
           
        
        //Not pending Cart - create new cart
        }elseif($cart_check_result['FK_Cart_Cust_ID']=='$cust_ID' && $cart_check_result['Cart_Status']!='pending'){
            
            //create cart
            $cart_create_query = mysqli_query($con,"INSERT INTO cart(Cart_TimeStamp, Cart_Status, FK_Cart_Cust_ID)
            VALUES ('$timeStamp','pending','$cust_ID')");

            //check newly created cart and get cart ID
            $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
            $cart_check_result = mysqli_fetch_array($cart_check_query);
            $cart_ID = $cart_check_result['Cart_ID'];

            //add item into cart_item
            $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID) 
            VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID')");
        }
    }
?>

<?php include("Interface/footer.php")?>