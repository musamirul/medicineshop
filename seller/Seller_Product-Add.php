
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

}
</style>
<?php include("Message_Notification.php"); ?>
<h4>Add Product</h4>
<small><b>Here you can add product to your store</b></small>

<div class="row">
    <div class="col-6 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <b>PRODUCT DETAILS</b> <br />
        <small>Add product details here</small>
        <br /><br />
        <form class="row g-3" method="post" enctype="multipart/form-data" >
            <div class="col-12">
            <label for="inputProduct" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="inputProduct" placeholder="Enter Product Name" name="Pname"/>
            </div>

            <div class="col-12">
            <label for="inputDescription" class="form-label">Product Description</label>
            <textarea id="summernote" class="form-control" rows="5" cols="50" name="description" placeholder="Enter Product Description"></textarea>
            </div>

            <div class="col-12">
            <label for="inputSpecification" class="form-label">Product Specification</label>
            <textarea id="summernote_spec" class="form-control" rows="5" cols="50" name="specification" placeholder="Enter Product Specification"></textarea>
            </div>
            
            
            <div class="col-md-2">
            <label for="inputQty" class="form-label">Stock Quantity</label>
            <input class="form-control" type="number" placeholder="Enter Product Qty" name="qty"/>
            </div>

            <div class="col-md-5">
            <label for="inputControlType" class="form-label">Select Product Category</label>
            <select class="form-control" name="prodCategory">
                <option value="neurology" selected>Brain & Eyes</option>
                <option value="ent">Ear, Nose & Throat</option>
                <option value="heart">Heart</option>
                <option value="lungs">Lungs</option>
                <option value="stomach">Stomach</option>
                <option value="liver">Liver</option>
                <option value="kidney">Kidney</option>
                <option value="ortho">Bone Joint & Muscle</option>
                <option value="skin">Skin, Hand & Nails</option>
                <option value="other">Others</option>
            </select>
            </div>
            <div class="col-md-5">
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
            <input class="form-control" type="text" name="price" placeholder="Enter Selling Price"/>
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
                    <input type="file" name="file"><br /><br />
                    <small style="color: red;" class="">NOTES:</small>
                    <small><i>Image can be uploaded of any dimension but we recommend you to upload image with dimension of 1024x1024 & its size must be less than 15mb</i></small>

                    <div class="col-12 mt-4">
                        <label for="inputDescription" class="form-label"><b>Product Tags</b></label>
                        <textarea class="form-control" rows="5" cols="50" name="prodTags" placeholder="Enter Product Tags"></textarea>
                        <small style="color: red;" class="">NOTES:</small>
                        <small><i>Puts comma ',' after each tags</i></small>
                    </div>
                </div>
        </form>
</div>
<?php
/*$query_image = mysqli_query($con,"SELECT * FROM product");
while($result_image = mysqli_fetch_array($query_image))
{
echo '<div id="imagelist">';
echo '<p><img class="imgProd" src="'.$result_image['Product_Image'].'"></p>';
echo '<p>'.$result_image['Product_Name'].'</p>';
echo '</div>';

}*/

if(isset($_POST['createProduct'])){
    $Pname = $_POST['Pname'];
    //remove all symbol from description
    $description = str_replace("'", '', $_POST['description']) ; 
    $specification = str_replace("'", '', $_POST['specification']) ;
    $qty = $_POST['qty'];
    $prodType = $_POST['prodType'];
    $recordType = $_POST['RecordType'];
    $expiredDate = $_POST['expiredDate'];
    $manufacturer = $_POST['manufacturer'];
    $price = $_POST['price'];
    $tags = $_POST['prodTags'];
    $prodCategory = $_POST['prodCategory'];
    $sellerID = $_SESSION['Seller_Id'];

    /*$file=$_FILES['image']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
			
    move_uploaded_file($_FILES["image"]["tmp_name"],"img/" . $_FILES["image"]["name"]);
    $location="img/" . $_FILES["image"]["name"];*/

    
    $name=$_FILES['file']['name'];
    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d h:i:sa");

    $fname = date("YmdHis").'_'.$name;
    $move = move_uploaded_file($temp,"img/".$fname);

    $query_addProduct = mysqli_query($con,"INSERT INTO product (Product_Name, Product_Desc, Product_Spec, Product_Image, Product_Qty, Product_Type, Product_Category, Product_RecordType, Product_ExpiracyDate, Product_ManufacturerName, Product_SellingPrice, Product_Tags, FK_Product_Seller_ID)
    VALUES ('$Pname','$description','$specification','img/$fname','$qty','$prodType','$prodCategory','$recordType','$expiredDate','$manufacturer','$price','$tags','$sellerID')");
    $_SESSION['message'] = 'Successfully Add Product '.$name;
    
    echo '<script>window.location.href="Seller_Product-Add.php"</script>';

           
    
}
?>
<?php include("Interface/footer.php"); ?>