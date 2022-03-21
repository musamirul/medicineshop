<?php include("Interface/header.php"); ?>
<?php 
    $Seller_ID = $_SESSION['Seller_Id'];

    //Array of Cust_ID
    $Cust_ID = array();
    $count = 0;
    $Temp_Cust_ID ="";
    $query_Order = mysqli_query($con,"SELECT * FROM orders WHERE FK_Order_Seller_ID = '$Seller_ID'");
    while($result_Order = mysqli_fetch_array($query_Order)){
        if($Temp_Cust_ID != $result_Order['FK_Order_Cust_ID']){
            $Temp_Cust_ID = $result_Order['FK_Order_Cust_ID'];
            $Cust_ID[$count] = $result_Order['FK_Order_Cust_ID'];
        }
        $count++;
    }

?>
<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-people-fill"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Customer List</span> <br/>
                    <span style="font-size: 14px; color: grey;">View your list of customer</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <table id="example" class="display center" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Contact No</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        for($x = 0; $x < count($Cust_ID); $x++){
                        $ArrayCust = $Cust_ID[$x];

                        //Customer Table
                        $query_cust = mysqli_query($con,"SELECT * FROM customer WHERE Cust_ID='$ArrayCust'");
                        $result_cust = mysqli_fetch_array($query_cust);

                        //Customer Shipping table
                        $query_shipping = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID = '$ArrayCust'");
                        $query_shipping = mysqli_fetch_array($query_shipping);
                        
                    ?>
                    <tr>
                        <td><?php echo $result_cust['Cust_Name'] ?></td>
                        <td><?php echo $result_cust['Cust_DOB'] ?></td>
                        <td><?php echo $result_cust['Cust_Gender'] ?></td>
                        <td><?php echo $result_cust['Cust_Phone'] ?></td>
                        <td><?php echo $result_cust['Cust_Email'] ?></td>
                        <td><?php echo $query_shipping['address'].','.$query_shipping['city'].','.$query_shipping['state'].','.$query_shipping['zipcode'].' '.$query_shipping['country']?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- View Product list -->
<div class="modal fade" id="productView<?php echo $Cart_ID ?>" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-fullscreen">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">View Product Order <strong>#<?php echo $Order_ID ?></strong></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
            <div class="form-group row">
              <div class="col-sm-12">
                <div class="row m-2 p-2">
                    <div style="font-weight: bold;" class="col">Image</div>
                    <div style="font-weight: bold;" class="col">Name</div>
                    <div style="font-weight: bold;" class="col">Quantity</div>
                    <div style="font-weight: bold;" class="col">Price</div>
                </div>
                <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <?php 
                    $Cart_ID;
                    $Cust_ID;
                    $Seller_ID;

                    $query_cartItem = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Cart_ID ='$Cart_ID' AND FK_Item_Seller_ID='$Seller_ID'");
                    while($result_cartItem=mysqli_fetch_array($query_cartItem)){

                        $Product_ID = $result_cartItem['FK_Item_Product_ID'];
                        $query_product = mysqli_query($con,"SELECT * FROM product WHERE Product_ID = '$Product_ID'");
                        $result_product = mysqli_fetch_array($query_product);

                ?>
                <div class="row m-2 p-2">
                    <div class="col"><img style="height: 6rem; width:6rem;" src="../seller/<?php echo $result_product['Product_Image']; ?>"></div>
                    <div class="col mt-4"><?php echo $result_product['Product_Name'] ?></div>
                    <div class="col mt-4"><?php echo $result_cartItem['Cart_Item_Qty']?> qty</div>
                    <div class="col mt-4">RM <?php echo $result_cartItem['Cart_Item_Amount'] ?></div>
                </div>
                <span class="d-grid mx-auto" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <?php
                    }
                ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </form>
          </div>   
      </div>
    </div>
  </div>

<?php include("Interface/footer.php"); ?>