<?php include("Interface/header.php"); ?>
<?php


$Seller_ID = $_SESSION['Seller_Id'];
$query_shop = mysqli_query($con,"SELECT * FROM seller_shop WHERE FK_Shop_Seller_ID='$Seller_ID'");
$result_shop = mysqli_fetch_array($query_shop);

$query_seller = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID = '$Seller_ID'");
$result_seller = mysqli_fetch_array($query_seller);

$query_product = mysqli_query($con,"SELECT * FROM product WHERE FK_Product_Seller_ID = '$Seller_ID'");
$result_row = mysqli_num_rows($query_product);
?>
<?php include("Message_Notification.php")?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-pencil-square"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Shop Profile</span> <br/>
                    <span style="font-size: 14px; color: grey;">View your shop status and update your shop profile</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <div class="row mb-3">
                <span style="font-weight: bold; font-size: 14px;">Basic Information</span>
            </div>
            <div class="row position-relative">
                <?php if($result_shop['Shop_Img']==""){ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editProfile" src="tempProfile.png" class="rounded-circle position-absolute top-50 start-0" style="height: 125px; width: 145px;">                   
                <?php }else{ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editProfile" src="shop_img/<?php echo $result_shop['Shop_Img'] ?>" class="rounded-circle position-absolute top-50 start-0" style="height: 125px; width: 145px;">                   
                <?php } ?>
                
                <?php if($result_shop['Shop_Cover']==""){ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editCover" src="temp.jpg" class="img-fluid" style="height: 200px;">
                <?php }else{ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editCover" src="shop_img/<?php echo $result_shop['Shop_Cover'] ?>" class="img-fluid" style="height: 200px;">
                <?php } ?>
            </div>
        </div>
        <div class="row p-5">
            <div class="col">
              <div class="row">
                <div class="col-4">
                  <div class="card">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <h5 class="card-title">Shop Name</h5>
                        <input type="text" class="form-control" value="<?php echo $result_seller['Seller_Name']; ?>" name="name" disabled/>
                      </li>
                      <li class="list-group-item ms-2 me-2">
                        <i class="bi bi-gift-fill"></i>  Products <span class="float-end text-danger"><a class="text-decoration-none text-danger" href="Seller_Product-View.php"><?php echo $result_row; ?></a></span>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-8">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title">Shop Description</h5>
                      <form method="post">
                        <textarea id="summernote_spec" class="form-control" rows="5" cols="50" name="description" placeholder="Enter Product Specification"><?php echo $result_shop['Shop_Desc'] ?></textarea>
                        <button type="submit" name="editDescBtn" class="btn btn-primary mt-2">Save</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit <strong>Profile Image</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
              <label>Image Location :</label>
                    <div class="col"><input class="form-control" type="file" name="Profilefile"/></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="editProfileBtn" class="btn btn-primary">Edit</button>
          </form>
          </div>   
      </div>
    </div>
  </div>

<!-- Edit Cover Modal -->
<div class="modal fade" id="editCover" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit <strong>Cover Image</strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <form enctype="multipart/form-data" method="post">
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
              <label>Image Location :</label>
                    <div class="col"><input class="form-control" type="file" name="Coverfile"/></div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="editCoverBtn" class="btn btn-primary">Edit</button>
          </form>
          </div>   
      </div>
    </div>
  </div>
<?php
    if(isset($_POST['editProfileBtn'])){
       
        $name=$_FILES['Profilefile']['name'];
        $size=$_FILES['Profilefile']['size'];
        $type=$_FILES['Profilefile']['type'];
        $temp=$_FILES['Profilefile']['tmp_name'];

        //get date and time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Y-m-d h:i:sa");

        $fname = date("YmdHis").'_'.$name;
        $move = move_uploaded_file($temp,"shop_img/".$fname);

        $query_updateShop = mysqli_query($con,"UPDATE seller_shop SET Shop_Img='$fname',Shop_Img_File='$name' WHERE FK_Shop_Seller_ID = '$Seller_ID'");
        echo '<script>window.location.href="Seller_Shop_Profile?msg=success"</script>';
    
    }


    if(isset($_POST['editCoverBtn'])){
        
        $name=$_FILES['Coverfile']['name'];
        $size=$_FILES['Coverfile']['size'];
        $type=$_FILES['Coverfile']['type'];
        $temp=$_FILES['Coverfile']['tmp_name'];

        //get date and time
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $date = date("Y-m-d h:i:sa");

        $fname = date("YmdHis").'_'.$name;
        $move = move_uploaded_file($temp,"shop_img/".$fname);
        $query_updateShop = mysqli_query($con,"UPDATE seller_shop SET Shop_Cover='$fname',Shop_Cover_File='$name' WHERE FK_Shop_Seller_ID = '$Seller_ID'");
        echo '<script>window.location.href="Seller_Shop_Profile.php?msg=success"</script>';
    }

    if(isset($_POST['editDescBtn'])){
      $shop_desc = str_replace("'", '', $_POST['description']) ;
      
      $query_updateDesc = mysqli_query($con,"UPDATE seller_shop SET Shop_Desc='$shop_desc' WHERE FK_Shop_Seller_ID = '$Seller_ID'");
      $_SESSION['message'] = 'Successfully update shop description';
      echo '<script>window.location.href="Seller_Shop_Profile.php?msg=success"</script>';
    }
?>
<?php include("Interface/footer.php"); ?>