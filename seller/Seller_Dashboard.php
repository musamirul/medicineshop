<?php include("Interface/header.php") ?>
<?php 
  $seller_id = $_SESSION['Seller_Id'];
  $query_orders = mysqli_query($con,"SELECT count(*) FROM orders WHERE FK_Order_Seller_ID = '$seller_id'");
  $result_orders = mysqli_fetch_array($query_orders);
  $totalOrders = $result_orders[0];

  $TotalIncome = 0;
  $query_income = mysqli_query($con,"SELECT * FROM transaction WHERE Transaction_Type = 'income' AND FK_Transaction_Seller_ID = '$seller_id'");
  while($result_income = mysqli_fetch_array($query_income)){
    $TotalIncome = $TotalIncome + $result_income['Transaction_Amount'];
  }

  $query_product = mysqli_query($con,"SELECT count(*) FROM product WHERE FK_Product_Seller_ID = '$seller_id'");
  $result_product = mysqli_fetch_array($query_product);
  $totalProduct = $result_product[0];


  //Array of Cust_ID
  $Cust_ID = array();
  $count = 0;
  $Temp_Cust_ID ="";
  $query_Order = mysqli_query($con,"SELECT * FROM orders WHERE FK_Order_Seller_ID = '$seller_id'");
  while($result_Order = mysqli_fetch_array($query_Order)){
      if($Temp_Cust_ID != $result_Order['FK_Order_Cust_ID']){
          $Temp_Cust_ID = $result_Order['FK_Order_Cust_ID'];
          $Cust_ID[$count] = $result_Order['FK_Order_Cust_ID'];
      }
      $count++;
  }
?>
<div class="row">
    <div class="col-12 p-3 mb-5 bg-body  rounded me-5 shadow-sm">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Dashboard</span> <br/>
                    <span style="font-size: 14px; color: grey;">Ecommerce Dashboard</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <div class="col">
              <div class="card text-dark bg-info mb-3  opacity-75" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div style="color:white; font-size:13px; font-weight:600">TOTAL ORDERS</div>
                          <span style="color:white; font-size:20px; font-weight:600"><?php echo $totalOrders; ?></span>
                        </div>
                        <div class="col pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-basket3-fill p-2 text-info"></i>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card text-dark bg-success mb-3  opacity-75" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div style="color:white; font-size:13px; font-weight:600">TOTAL INCOME</div>
                          <span style="color:white; font-size:20px; font-weight:600">RM<?php echo $TotalIncome; ?></span>
                        </div>
                        <div class="col pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-currency-dollar p-2 text-success"></i>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card text-dark bg-warning mb-3 opacity-75" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div style="color:white; font-size:13px; font-weight:600">TOTAL PRODUCT</div>
                          <span style="color:white; font-size:20px; font-weight:600"><?php echo $totalProduct; ?></span>
                        </div>
                        <div class="col pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-plus-circle-fill p-2 text-warning"></i>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="card text-dark bg-primary mb-3 opacity-75" style="max-width: 18rem;">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                          <div style="color:white; font-size:13px; font-weight:600">TOTAL CUSTOMER</div>
                          <span style="color:white; font-size:20px; font-weight:600"><?php echo sizeof($Cust_ID); ?></span>
                        </div>
                        <div class="col pe-4 pt-2 text-end float-end">
                          <div class="rounded-circle float-end" style="height:40px; width:40px; background-color: white;">
                            <i style="font-size: 25px;" class="bi bi-people-fill p-2 text-primary"></i>
                          </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            
        </div>
        <div class="row pt-2 ps-5 pe-5">
          <div class="col">
            <div class="card text-dark bg-light mb-3">
              <div class="card-header">Top Selling Products</div>
              <div class="card-body">
                <?php
                  $query_productData = mysqli_query($con,"SELECT * FROM cart_item WHERE FK_Item_Seller_ID = '$seller_id' ORDER BY Cart_Item_ID DESC LIMIT 3");
                  while($result_productData = mysqli_fetch_array($query_productData)){
                ?>
                <h5 class="card-title">Light card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col"></div>
        </div>
    </div>
</div>
<?php include("Interface/footer.php") ?>
