
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
<h5>Add Product</h5>
<form method="post" enctype="multipart/form-data" >
    <input type="text" placeholder="Enter Product Name" name="name"/><br/>
    <textarea rows="5" cols="50" name="description" placeholder="Enter Product Description"></textarea><br/>
    <input type="file" name="image"><br />
    <input type="number" placeholder="Enter Product Qty" name="qty"/><br/>
    <span>Select product type :</span>
    <select name="prodType">
        <option value="control" selected>controlled medicine</option>
        <option value="noncontrol">non-controlled medicine</option>
    </select><br/>
    <span>Does customer need to upload prescription to purchase ?</span>
    <input type="radio" name="RecordType" value="yes" checked>Yes
    <input type="radio" name="RecordType" value="no">No
    <br/>
    <span>Enter Expired Date :</span>
    <input type="date" name="expiredDate"/><br/>
    <input type="text" name="manufacturer" placeholder="Enter Manufacturer Name"/><br/>
    <input type="number" name="price" placeholder="Enter Selling Price"/><br/>
    <button type="submit" name="createProduct">Created Product</button>
</form>
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

            header("Location:Seller_Product-Add.php");
    
}
?>
<?php include("Interface/footer.php"); ?>