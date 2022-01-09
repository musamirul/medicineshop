<?php include("Interface/header.php"); ?>
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
  <div class="row">
    <div class="col-6">
      <h4>All Product</h4>
      <small><b>Here are the Current Products on your Store</b></small>
      
    </div>
    <div class="col-6">
      <button type="button" class="btn btn-primary float-end"><i class="bi bi-plus-lg">&nbsp;</i><a class="text-reset text-decoration-none" href="Seller_Product-Add.php">Add Product</a></button>
    </div>
</div>
  <div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">

      <table id="example" class="display center" style="width: 100%; text-align: center;">
        <thead>
          <tr>
            <th>Product ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Type</th>
            <th>Record</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php
          $query_image = mysqli_query($con,"SELECT * FROM product");
          while($result_image = mysqli_fetch_array($query_image))
          {
            $id = $result_image['Product_ID'];
            $name = $result_image['Product_Name'];
        ?>
          <tr>
            <td><?php echo $result_image['Product_ID'] ?></td>
            <td><?php echo '<div id="imagelist"><img class="imgProd" src="'.$result_image['Product_Image'].'"></div>' ?></td>
            <td><?php echo $result_image['Product_Name'] ?></td>
            <td><?php echo $result_image['Product_Type'] ?></td>
            <td><?php echo $result_image['Product_RecordType'] ?></td>
            <td>RM <?php echo $result_image['Product_SellingPrice'] ?></td>
            <td><?php echo $result_image['Product_Qty'] ?> Pcs.</td>
            <td>
              <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actionButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-list-ul"></i>
              </button>
              <ul class="dropdown-menu" aria-labelledby="actionButton">
                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil-square"></i> Edit</a></li>
                <li><a class="dropdown-item" href="#"><button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $id ?>"><i class="bi bi-x-square-fill"></i> Delete</a></button></li> 
              </ul>
            </td>
          </tr>

      <!-- Delete Modal -->
       <div class="modal fade" id="deleteModal<?php echo $id?>" tabindex="-1" aria-labelledby="deleteModalLabel" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete <?php echo $result_image['Product_ID']?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
                <div class="modal-body">
                  <div class="alert alert-danger">Are you want to delete? <strong><?php echo  $result_image['Product_Name']?></strong></div>      
                </div> 
                <div class="modal-footer">
                  <form method="post">
                    <input type="hidden" value="<?php echo $result_image['Product_ID']?>" name="idDelete" />
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="deleteProduct" class="btn btn-primary">DELETE</button>
                  </form>
                </div>   
            </div>
          </div>
        </div>

      <!-- php Delete Modal script-->
       <?php
          if(isset($_POST['deleteProduct'])){
            $idDelete = $_POST['idDelete'];
            $deleteQuery = mysqli_query($con,"DELETE FROM product WHERE Product_ID = '$idDelete'");
            echo '<script>window.location.href="Seller_Product-View.php"</script>';
          }
       ?>

        <?php
        //end of while($image_result)
          }
        ?>
        </tbody>
      </table>

  </div>
<?php include("Interface/footer.php"); ?>