
<?php include("Interface/header.php"); ?>
<style type="text/css">

#imagelist{
border: thin solid silver;
float:left;
padding:5px;
width:auto;
margin: 0 5px 0 0;
}

.imgProd{
height: 225px;

</style>

<h4>Add Product</h4>
<small><b>Here you can add product to your store</b></small>
<div class="row">
    <div class="col-6 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <b>PRODUCT DETAILS</b> <br />
        <small>Add product details here</small>
        <br /><br />
        <form class="row g-3" method="post" enctype="multipart/form-data" >
            <div class="col-12>
            <label for="inputProduct" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="inputProduct" placeholder="Enter Product Name" name="name"/>
            </div>

            <div class="col-12">
            <label for="inputDescription" class="form-label">Product Description</label>
            <textarea class="form-control" rows="5" cols="50" name="description" placeholder="Enter Product Description"></textarea>
            </div>

            
            <div class="col-md-6">
            <label for="inputQty" class="form-label">Stock Quantity</label>
            <input class="form-control" type="number" placeholder="Enter Product Qty" name="qty"/>
            </div>

            <div class="col-md-6">
            <label for="inputControlType" class="form-label">Select Product Type</label>
            <select class="form-control" name="prodType">
                <option value="control" selected>controlled medicine</option>
                <option value="noncontrol">non-controlled medicine</option>
            </select>
            </div>

            <div class="col-md-4">
            <label for="inputExpired" class="form-label">Product Expired Date</label>
            <input class="form-control" type="date" name="expiredDate"/>
            </div>
            
            <div class="col-md-4">
            <label for="inputManufacturer" class="form-label">Manufacturer Name</label>
            <input class="form-control" type="text" name="manufacturer" placeholder="Enter Manufacturer Name"/>
            </div>
            
            <div class="col-md-4">
            <label for="inputPrice" class="form-label">Selling Price</label>
            <input class="form-control" type="number" name="price" placeholder="Enter Selling Price"/>
            </div>

            <div class="col-sm-10">
                <legend class="col-form-label">Does customer need to upload prescription to purchase ?</legend>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="RecordType" value="yes" checked>
                <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="RecordType" value="no">
                <label class="form-check-label">No</label>
                </div>
            </div>
            
            <button class="btn btn-primary" type="submit" name="createProduct">Created Product</button>
        
    </div>
        <div class="col-4 bg-white shadow-sm p-3 mb-5 bg-body rounded me-3">
            <b>PRODUCT IMAGE</b> <br />
            <small>Here you can upload images of product. You are allowed to upload 1 image only</small>
            <br /><br />
            <input type="file" name="image"><br /><br />
            <small style="color: red;" class="">NOTES:</small>
            <small><i>Image can be uploaded of any dimension but we recommend you to upload image with dimension of 1024x1024 & its size must be less than 15mb</i></small>
        </div>
    </form>
</div>
<?php
$query_image = mysqli_query($con,"SELECT * FROM product");
while($result_image = mysqli_fetch_array($query_image))
{
echo '<div id="imagelist">';
echo '<p><img class="imgProd" src="'.$result_image['Product_Image'].'"></p>';
echo '<p>'.$result_image['Product_Name'].'</p>';
echo '</div>';

}

if(isset($_POST['createProduct'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $qty = $_POST['qty'];
    $prodType = $_POST['prodType'];
    $recordType = $_POST['RecordType'];
    $expiredDate = $_POST['expiredDate'];
    $manufacturer = $_POST['manufacturer'];
    $price = $_POST['price'];
    $sellerID = $_SESSION['Seller_Id'];

    $file=$_FILES['image']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
			
			move_uploaded_file($_FILES["image"]["tmp_name"],"img/" . $_FILES["image"]["name"]);
            $location="img/" . $_FILES["image"]["name"];
            $query_addProduct = mysqli_query($con,"INSERT INTO product (Product_Name, Product_Desc, Product_Image, Product_Qty, Product_Type, Product_RecordType, Product_ExpiracyDate, Product_ManufacturerName, Product_SellingPrice, FK_Product_Seller_ID)
            VALUES ('$name','$description','$location','$qty','$prodType','$recordType','$expiredDate','$manufacturer','$price','$sellerID')");

    
}
?>
<?php include("Interface/footer.php"); ?>