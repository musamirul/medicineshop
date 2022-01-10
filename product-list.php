<?php
    include("includes/config.php");
    include("Interface/header.php");
?>
<style type="text/css">

#imagelist{
border: thin solid silver;
padding:5px;

margin: 0 5px 0 0;
}

.imgProd{
height: 60px;

}
</style>
<div class="col-12">
<form method="post">
    <input class="form-control form-control-lg" type="text" name="productSearch" placeholder="Search for product, brand and shop">
    <button type="submit" name="searchButton">Search</button>
</form>
</div>
<div class="col-12">
    <?php
        if($_POST['productSearch']==""){
            $productSearch = 'acid';
        }else{
            $productSearch = $_POST['productSearch'];
        }
        $searchQuery = mysqli_query($con,"SELECT * FROM product
        WHERE Product_Tags LIKE '%$productSearch%'");
        
        while($searchResult = mysqli_fetch_array($searchQuery))
        {
            echo '<p><img class="imgProd" src="seller/'.$searchResult['Product_Image'].'"></p>';
            echo $searchResult['Product_Image'];
        }
    ?>
</div>


<?php include("Interface/footer.php")?>