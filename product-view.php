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
        <div class="col-2 m-3">
            <img src="" class="rounded-circle"/>
        </div>
    </div>
</div>

<div class="container mt-3 bg-white shadow bg-body rounded">
    <p>Product Specification</p>
</div>




<?php
include("Interface/footer.php")
?>