<?php

    include("Interface/header.php");
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

<div class="col-12 mt-5">
    <div class="container">
        <div class="row">
            <?php
                if(isset($_POST['searchButton'])){
                    $productSearch = $_POST['productSearch'];
                    
                    $searchQuery = mysqli_query($con,"SELECT * FROM product
                    WHERE Product_Tags LIKE '%$productSearch%'");
                    
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
                }
            ?>
        </div>
    </div>
</div>


<?php include("Interface/footer.php")?>