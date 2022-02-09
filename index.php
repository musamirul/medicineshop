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
<div class="col-12 mb-5 pb-5">
    <div class="container mb-5 pb-5 pt-5">
        <div class="row">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="2000">
                    <img src="Interface/style/image/banner3.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                    <img src="Interface/style/image/banner4.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                    </div>
                    <div class="carousel-item">
                    <img src="Interface/style/image/banner5.png" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row pt-5 pb-4 ps-5"><span style="font-size: 25px;">New Arrivals</span></div>
                <div class="row rows-cols-1 g-4">
                    <div class="card-group">
                        <?php 
                            $query_product = mysqli_query($con,"SELECT * FROM product ORDER BY Product_ID DESC LIMIT 6");
                            while($result_product = mysqli_fetch_array($query_product)){
                            $substr = substr($result_product['Product_Desc'],0,100);
                        ?>
                        <div class="col p-2">
                            <a class="text-decoration-none text-reset" href="product-view.php?prodId=<?php echo $result_product['Product_ID']?>">
                            <div class="card h-100 shadow">
                                <center><img style="height:160px; width:150px" src="<?php echo 'seller/'.$result_product['Product_Image']; ?>" class="card-img-top" alt="..."></center>
                                <div class="card-body">
                                    <h5 style="font-size: 15px;" class="card-title"><?php echo $result_product['Product_Name']; ?></h5>
                                    <p><small class="text-muted"><?php echo $result_product['Product_ManufacturerName']; ?></small></p>
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
        </div>
        <div class="row">
            <div class="col">
                <div class="row pt-5 pb-4 ps-5"><span style="font-size: 25px;">Explore By Shop</span></div>
                <div class="d-flex flex-row bd-highlight mb-3 ms-4">
                    
                        <?php 
                            $query_shop = mysqli_query($con,"SELECT * FROM seller_shop");
                            while($result_shop = mysqli_fetch_array($query_shop)){
                        ?>
                        <div class="ms-3 me-3 p-2 bd-highlight shadow-sm">
                            <center><a href="shop-view.php?sellerId=<?php echo $result_shop['FK_Shop_Seller_ID']?>"><img style="height:100px; width:100px" src="<?php echo 'seller/shop_img/'.$result_shop['Shop_Img']; ?>" class="card-img-top"></a></center>
                        </div>
                        <?php 
                            }
                        ?>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row pt-5 ps-5"><span style="font-size: 25px;">Read Top Articles From Health Experts</span></div>
                <p class="ps-5"><small class="text-muted">Our health articles keep you informed about best practices to achieve your health goals.</small></p>
                <div class="row ps-2 mt-4 ms-4">
                    <?php
                        $query_healthinfo = mysqli_query($con,"SELECT * FROM healthinfo ORDER BY rand() DESC LIMIT 4");
                        while($result_healthinfo = mysqli_fetch_array($query_healthinfo)){
                    ?>
                    <div class="col-sm-6">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <!--<div class="col-md-4">
                                <img src="..." class="img-fluid rounded-start" alt="...">
                                </div>-->
                                <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <form method="post" action="healthinfo-list.php">
                                            <input type="hidden" value="<?php echo $result_healthinfo['HealthInfo_Title'] ?>" name="articleSearch">
                                            <button style="font-size: 16px; font-weight:600;" class="btn btn-link text-decoration-none text-reset p-0" name="searchButton" type="submit"><span style="color: rgb(0, 140, 255);"><?php echo $result_healthinfo['HealthInfo_Title'] ?><span></button>
                                        </form>
                                    </h5>
                                    <p class="card-text"><?php echo substr($result_healthinfo['HealthInfo_Desc'],0,100) ?></p>
                                    <p class="card-text"><small class="text-muted">Publish Date : <?php echo $result_healthinfo['HealthInfo_Date']; ?></small></p>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("Interface/footer.php")?>