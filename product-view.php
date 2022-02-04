<?php
//include("includes/config.php");
include("Interface/header.php");
/*$_SESSION['id'];
$_SESSION['username'];
$_SESSION['role'];
$_SESSION['Cust_Id'];*/

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

//Select shop
$shop_query = mysqli_query($con,"SELECT * FROM seller_shop WHERE FK_Shop_Seller_ID = '$FK_Seller_ID'");
$shop_result = mysqli_fetch_array($shop_query);
$shop_img = $shop_result['Shop_Img'];

?>

<?php
//Count total product
$count_query = mysqli_query($con,"SELECT count('Product_ID') AS total_id FROM product WHERE FK_Product_Seller_ID = '$FK_Seller_ID'");
$count_result = mysqli_fetch_object($count_query);

?>

<div class="container bg-white shadow bg-body rounded">
    <form method="post">
    <div class="row">
        <div style="position:relative" class="col-5 mt-3 mb-4">
            <center><img class="img-fluid" style="height: 25rem;" src="seller/<?php echo $product_result['Product_Image']; ?>"></center>
            <?php
                if($product_result['Product_RecordType']=='yes'){ 
            ?>
            <div style="position:absolute; top:-5px; left:-4px;color: white;" class="bg-danger p-1">Prescribed medicine</div>
            <?php
                }
            ?>
        </div>
        <div class="col-7 mt-3 mb-5">
            <div class="col">
                <h5><?php echo $product_result['Product_Name']?></h5>
            </div>
            <div class="col p-2 bg-light">
                <span class="text-danger fs-4"><b>RM<?php echo $product_result['Product_SellingPrice'] ?></b></span>
            </div>
            <div class="col p-3">
                <span>Shipping</span>
            </div>
            <div class="col p-3">
                <div class="row">
                    <label class="col-sm-2 col-form-label">Quantity</label>
                    <div class="col-sm-2">
                        <input type="number" name="quantity" class="form-control" placeholder="Number" required>
                    </div>
                    <label class="col-sm-3 col-form-label"><?php echo $product_result['Product_Qty'] ?> Pieces Available</label>
                </div>
            </div>
            <?php 
                //if producttype is yes display prescription document
                if($product_result['Product_RecordType']=='yes'){
            ?>
            <div class="col bg-warning p-3">
                <div class="row">
                    <label class="col-sm-2 col-form-label">Pres Doc :</label>
                    <div style="position:relative" class="col-sm-4">
                        <select class="form-select" name="record_id" size="3">
                            <?php
                                $record_cust_ID = $_SESSION['Cust_Id'];
                                //count record
                                $query_CountRecord = mysqli_query($con,"SELECT * FROM record WHERE FK_Record_Cust_ID = '$record_cust_ID'");
                                $result_CountRecord = mysqli_fetch_array($query_CountRecord);

                                //display record
                                $query_record = mysqli_query($con,"SELECT * FROM record WHERE FK_Record_Cust_ID = '$record_cust_ID'");
                                while($result_record = mysqli_fetch_array($query_record))
                                {
                            ?>
                            <option value="<?php echo $result_record['Record_ID'];  ?>"><?php echo $result_record['Record_FileName']; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <div style="position:absolute; top:-20px;left:-4px">
                            <a data-bs-toggle="modal" data-bs-target="#uploadRecord" href="" class="text-decoration-none text-reset"><i style="font-size: 30px;"  data-bs-toggle="tooltip" data-bs-placement="top" title="Upload Prescription Document" class="bi bi-plus-circle-fill text-primary"></i></a>
                        </div>

                    </div>
                        <label style="font-size:14px" class="col col-form-label"> Please select/add prescription document to proceed Add to Cart</label>
                </div>
            </div>
            <?php }else{?>
                <input type="hidden" name="record_id" value="0">
            <?php }?>
            <div class="col mt-3">
                <?php  if(!isset($_SESSION['Cust_Id'])){ ?>
                    <span>Please <a href="Login.php" class="text-decoration-none fw-bold">Login</a> to purchase item</span>
                <?php  }else{ ?>

                    <?php if($product_result['Product_RecordType']=='no'){ ?>

                        <button type="submit" name="AddToCart" class="btn btn-secondary">Add To Cart</button>
                        <button type="submit" class="btn btn-dark">Buy Now</button>

                    <?php }elseif($product_result['Product_RecordType']=='yes'){ ?>
                        <?php if($result_CountRecord[0]==0){ ?>
                            <span>Please add prescription document to purchase this item</span>
                        <?php }else{ ?>
                            <button type="submit" name="AddToCart" class="btn btn-secondary">Add To Cart</button>
                            <button type="submit" class="btn btn-dark">Buy Now</button>
                        <?php } ?>
                    <?php } ?>
                <?php }; ?>
            </div>
        </div>
    </div>
    </form>
</div>

<div class="container mt-3 bg-white shadow bg-body rounded">
    <div class="row">
        <div class="col-1 m-3">
            <img src="seller/shop_img/<?php echo $shop_img; ?>" class="rounded-circle img-thumbnail"/>
        </div>
        <div class="col-3 m-3">
            <div class="d-flex flex-column bd-highlight">
                <div class="p-2 bd-highlight"><?php echo $seller_result['Seller_Name']; ?></div>
                <div class="p-2 bd-highlight"><button class="btn btn-primary">View Shop</button></div>
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
<!-- Upload Record -->
<div class="modal fade" id="uploadRecord" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel"><strong>Upload Record</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <div class="form-group row">
                <div class="col-sm-12">
                    <form enctype="multipart/form-data" method="post">
                    <div class="col"><input class="form-control" type="file" name="file" required/></div> 
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
          </div>   
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
        $record_id = $_POST['record_id'];

        date_default_timezone_set("Asia/Kuala_Lumpur");
        $timeStamp = date("Y-m-d h:i:sa");


        $cart_status = array();
        $count = 0;
        $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID'");
        while($cart_check_result = mysqli_fetch_array($cart_check_query)){
            if($cart_check_result['Cart_Status']=='pending'){
                $cart_status[$count] = $cart_check_result['Cart_Status'];
            }
            $count++;
        }
        if(in_array('pending',$cart_status)){
            
            $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
            $cart_check_result = mysqli_fetch_array($cart_check_query);
            $cart_ID = $cart_check_result['Cart_ID'];

            //add item into cart_item
            $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID, FK_Item_Shipping_ID, FK_Item_Record_ID) 
            VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID','1','$record_id')");

        }else{
                $cart_create_query = mysqli_query($con,"INSERT INTO cart(Cart_TimeStamp, Cart_Status, FK_Cart_Cust_ID)
                VALUES ('$timeStamp','pending','$cust_ID')");

                //check newly created cart and get cart ID
                $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
                $cart_check_result = mysqli_fetch_array($cart_check_query);
                $cart_ID = $cart_check_result['Cart_ID'];

                //add item into cart_item
                $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID, FK_Item_Shipping_ID, FK_Item_Record_ID) 
                VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID','1','$record_id')");
        }
        //New profile Account, never have cart
            /*if($cart_check_result['FK_Cart_Cust_ID']==""){
                //create cart
            
                $cart_create_query = mysqli_query($con,"INSERT INTO cart(Cart_TimeStamp, Cart_Status, FK_Cart_Cust_ID)
                VALUES ('$timeStamp','pending','$cust_ID')");

                //check newly created cart and get cart ID
                $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
                $cart_check_result = mysqli_fetch_array($cart_check_query);
                $cart_ID = $cart_check_result['Cart_ID'];

                //add item into cart_item
                $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID, FK_Item_Shipping_ID, FK_Item_Record_ID) 
                VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID','1','$record_id')");


            //Pending Cart
            }elseif($cart_check_result['FK_Cart_Cust_ID']=="$cust_ID" && $cart_check_result['Cart_Status']=="pending"){
                //check pending cart and get cart ID
                $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
                $cart_check_result = mysqli_fetch_array($cart_check_query);
                $cart_ID = $cart_check_result['Cart_ID'];

                //add item into cart_item
                $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID, FK_Item_Shipping_ID, FK_Item_Record_ID) 
                VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID','1','$record_id')");
            
            
            //Not pending Cart - create new cart
            }elseif($cart_check_result['FK_Cart_Cust_ID']=="$cust_ID" && $cart_check_result['Cart_Status']=="payment_completed"){

                //create cart
                $cart_create_query = mysqli_query($con,"INSERT INTO cart(Cart_TimeStamp, Cart_Status, FK_Cart_Cust_ID)
                VALUES ('$timeStamp','pending','$cust_ID')");

                //check newly created cart and get cart ID
                $cart_check_query = mysqli_query($con,"SELECT * FROM cart WHERE FK_Cart_Cust_ID = '$cust_ID' AND Cart_Status = 'pending'");
                $cart_check_result = mysqli_fetch_array($cart_check_query);
                $cart_ID = $cart_check_result['Cart_ID'];

                //add item into cart_item
                $cartItem_query = mysqli_query($con,"INSERT INTO cart_item (Cart_Item_Qty, Cart_Item_Amount, FK_Cart_ID, FK_Item_Product_ID, FK_Item_Seller_ID, FK_Item_Shipping_ID, FK_Item_Record_ID) 
                VALUES ('$quantity','$product_Price','$cart_ID','$product_ID','$seller_ID','1','$record_id')");

                
            }*/
        
    }
?>
<?php
if(isset($_POST['submit'])){
    $name=$_FILES['file']['name'];
    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];


    //get date and time
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d h:i:sa");

    $fname = date("YmdHis").'_'.$name;
    $move = move_uploaded_file($temp,"customer/upload/".$fname);
    
    $query_uploadFile=mysqli_query($con,"INSERT INTO record(Record_Timestamp, Record_File, Record_FileName, FK_Record_Product_ID, FK_Record_Cust_ID)
    VALUES ('$date','$fname','$name','0','$record_cust_ID')");
    echo '<script>window.location.href="product-view.php?prodId='.$id.'"</script>';
    //header("Location:cust_record-upload.php?msg=success");
    
}
?>
<?php //include("Interface/footer.php")?>