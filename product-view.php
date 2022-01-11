<?php
include("includes/config.php");
include("Interface/header.php");
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
    <div class="row">
        <div class="col-5 mt-3 mb-4">
            <center><img style="height: 24rem;" src="seller/<?php echo $product_result['Product_Image']; ?>"></center>
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
                        <input type="number" class="form-control" placeholder="Number">
                    </div>
                    <label class="col-sm-3 col-form-label"><?php echo $product_result['Product_Qty'] ?> Pieces Available</label>
                </div>
            </div>
            <div class="col mt-3">
                <button type="submit" class="btn btn-secondary">Add To Cart</button>
                <button type="submit" class="btn btn-dark">Buy Now</button>
            </div>
        </div>
    </div>
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
    </div>
</div>

<div class="container mt-3 bg-white shadow bg-body rounded">
    <div class="row">
        <div class="col m-3">
            <div class="col p-2 bg-light">
                <span style="font-size: 18px;">Product Description</span>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col ms-4 mb-3">
            <span style="font-size: 14px;"><?php echo $product_result['Product_Desc'] ?></span>
        </div>
    </div>
</div>



<?php
include("Interface/footer.php")
?>