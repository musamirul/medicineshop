<?php include("Interface/header.php"); ?>
<?php 
    $id = intval($_GET['sellerId']);
?>
<style type="text/css">

#imagelist{
border: thin solid silver;
padding:5px;

margin: 0 5px 0 0;
}

.imgProd{
height: 100px;

}
</style>
<?php 
    $query_countall = mysqli_query($con,"SELECT count(*) FROM product WHERE FK_Product_Seller_ID ='$id'");
    $result_countall = mysqli_fetch_array($query_countall);
    $allcount = $result_countall[0];
    
    //get seller information
    $query_seller = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID='$id'");
    $result_seller = mysqli_fetch_array($query_seller);

    //get seller shop
    $query_shop = mysqli_query($con,"SELECT * FROM seller_shop WHERE FK_Shop_Seller_ID='$id'");
    $result_shop = mysqli_fetch_array($query_shop);
?>
<div class="col-12">
    <div class="container">
        <div class="row bg-white shadow mb-4">
            <div class="row position-relative">
                <div style="position:absolute; margin-top:154px;" class="col">
                    <div class="row bg-dark ms-5 opacity-75 text-white">
                        <div class="ms-5 d-flex flex-row bd-highlight">
                            <div style="font-size:17px" class="p-2 bd-highlight fw-bold"><?php echo $result_seller['Seller_Name']; ?></div>
                            <div style="font-size:13px" class="p-2 bd-highlight"><i class="bi bi-telephone-fill"> </i> <?php echo $result_seller['Seller_Phone']; ?></div>
                            <div style="font-size:13px" class="p-2 bd-highlight"><i class="bi bi-basket3-fill"> </i> Products : <?php echo $allcount; ?></div>
                        </div>
                    </div>
                </div>
                <?php if($result_shop['Shop_Img']==""){ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editProfile" src="seller/tempProfile.png" class="rounded-circle position-absolute top-50 start-0" style="height: 125px; width: 145px;">                   
                <?php }else{ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editProfile" src="seller/shop_img/<?php echo $result_shop['Shop_Img'] ?>" class="rounded-circle position-absolute top-50 start-0" style="height: 125px; width: 145px;">                   
                <?php } ?>
                
                <?php if($result_shop['Shop_Cover']==""){ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editCover" src="seller/temp.jpg" class="img-fluid" style="height: 200px;">
                <?php }else{ ?>
                    <input type="image" data-bs-toggle="modal" data-bs-target="#editCover" src="seller/shop_img/<?php echo $result_shop['Shop_Cover'] ?>" class="img-fluid" style="height: 200px;">
                <?php } ?>
                
                
                
            </div>
        </div>
        <div class="row mb-5 shadow bg-white p-3">
            <span><?php echo $result_shop['Shop_Desc'] ?></span>
        </div>
        <div class="row mb-5 mt-5">
            <span class="mb-2">AVAILABLE PRODUCT</span>
            <?php
                    $searchQuery = mysqli_query($con,"SELECT * FROM product
                    WHERE FK_Product_Seller_ID ='$id'");
                    while($searchResult = mysqli_fetch_array($searchQuery))
                {
            ?>           
                <div style="position:relative" class="col-2 mb-3">
                    <a class="text-decoration-none text-reset" href="product-view.php?prodId=<?php echo $searchResult['Product_ID']?>">
                        <div class="card" style="width: 11rem;">
                            <img style="height: 10rem;" src="seller/<?php echo $searchResult['Product_Image']; ?>" class="card-img-top">
                            <?php
                                if($searchResult['Product_RecordType']=='yes'){ 
                            ?>
                            <div style="position:absolute; top:0px; left:-4px;color: white;" class="bg-danger p-1">Prescribed medicine</div>
                            <?php
                                }
                            ?>
                            <div class="card-body">
                                <p class="card-title" style="font-size: 13px;"><?php echo $searchResult['Product_Name'] ?></p>
                                <p class="card-text" style="font-size: 15px;color:red;">RM <?php echo $searchResult['Product_SellingPrice'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php            
                    }
            ?>
        </div>
    </div>
</div>


<?php include("Interface/footer.php") ?>