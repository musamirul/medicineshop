
<?php include("Interface/header.php")?>
<?php

$loginId = $_SESSION['Cust_Id'];
$current_file_name = basename($_SERVER['PHP_SELF']); 
?>

<div class="row mt-5">
    <div class="col-2 background-color:black;"></div>
    <!-- Left Navigation -->
    <div class="col-2">
        <?php include("Interface/sidebar.php") ?>
    </div>
    <!-- Addresses Page -->
    <div class="col-6 bg-white">
    <div class="m-3">
        <h5>My Addresses</h5>
        <div class="row">
            <div class="col">
            <span style="font-size: 13px;">Shipping address</span>
            <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div class="ms-5 me-5">
                <?php
                    //Check if shipping address already add into database
                        $query_check_address = mysqli_query($con,"SELECT * FROM shipping_address WHERE FK_ShipAdd_Cust_ID = $loginId");
                        $result_address = mysqli_fetch_array($query_check_address);
                        if($result_address>0){ ?>
                            
                        <div class="col mb-3">
                        <form method="POST">
                            <div class="row">
                                <textarea style="height:100px" class="form-control" name="address" placeholder="Enter address"><?php echo $result_address['address'] ?></textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input class="form-control"  type="text" name="city" value="<?php echo $result_address['city']; ?>" placeholder="City Name">
                                </div>
                                <div class="col">
                                    <select class="form-select" name="state">
                                        <option value="Selangor"  <?php if($result_address['state']=='Selangor'){echo 'selected';} ?>>Selangor</option>
                                        <option value="Johor"  <?php if($result_address['state']=='Johor'){echo 'selected';} ?>>Johor</option>
                                        <option value="Kedah"  <?php if($result_address['state']=='Kedah'){echo 'selected';} ?>>Kedah</option>
                                        <option value="Kelantan"  <?php if($result_address['state']=='Kelantan'){echo 'selected';} ?>>Kelantan</option>
                                        <option value="Malacca"  <?php if($result_address['state']=='Malacca'){echo 'selected';} ?>>Malacca</option>
                                        <option value="Pahang"  <?php if($result_address['state']=='Pahang'){echo 'selected';} ?>>Pahang</option>
                                        <option value="Penang"  <?php if($result_address['state']=='Perak'){echo 'selected';} ?>>Perak</option>
                                        <option value="Perlis"  <?php if($result_address['state']=='Perlis'){echo 'selected';} ?>>Perlis</option>
                                        <option value="Sabah"  <?php if($result_address['state']=='Sabah'){echo 'selected';} ?>>Sabah</option>
                                        <option value="Sarawak"  <?php if($result_address['state']=='Sarawak'){echo 'selected';} ?>>Sarawak</option>
                                        <option value="Terengganu"  <?php if($result_address['state']=='Terengganu'){echo 'selected';} ?>>Terengganu</option>
                                        <option value="Kuala_Lumpur"  <?php if($result_address['state']=='Kuala_Lumpur'){echo 'selected';} ?>>Kuala Lumpur</option>
                                        <option value="Labuan"  <?php if($result_address['state']=='Labuan'){echo 'selected';} ?>>Labuan</option>
                                        <option value="Putrajaya"  <?php if($result_address['state']=='Putrajaya'){echo 'selected';} ?>>Putrajaya</option> 
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" value="<?php echo $result_address['zipcode']; ?>"  name="zipcode" placeholder="Zipcode">
                                </div>
                                <div class="col">
                                    <select class="form-select" name="country">
                                        <option value="Malaysia" <?php if($result_address['country']=='Malaysia'){echo 'selected';} ?>>Malaysia</option>
                                        <option value="Singapura" <?php if($result_address['country']=='Singapura'){echo 'selected';} ?>>Singapura</option>
                                        <option value="Indonesia" <?php if($result_address['country']=='Indonesia'){echo 'selected';} ?>>Indonesia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <input type="hidden" value="<?php echo $result_address['ShipAdd_ID'] ?>" name="ship_id">
                                <button type="submit" class="btn btn-primary" name="btn_update_ship">Save Shipping Address</button>
                                </form>
                            </div>     
                        </div>


                        <?php }else{
                    ?>
                            <!-- Enter Shipping Address -->


                        <div class="col mb-3">
                            <form method="POST">
                            <div class="row">
                                <textarea style="height:100px" class="form-control" name="address" placeholder="Enter address"></textarea>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <input class="form-control"  type="text" name="city" placeholder="City Name">
                                </div>
                                <div class="col">
                                    <select class="form-select" name="state">
                                        <option value="Selangor" selected>Selangor</option>
                                        <option value="Johor">Johor</option>
                                        <option value="Kedah">Kedah</option>
                                        <option value="Kelantan">Kelantan</option>
                                        <option value="Malacca">Malacca</option>
                                        <option value="Pahang">Pahang</option>
                                        <option value="Penang">Perak</option>
                                        <option value="Perlis">Perlis</option>
                                        <option value="Sabah">Sabah</option>
                                        <option value="Sarawak">Sarawak</option>
                                        <option value="Terengganu">Terengganu</option>
                                        <option value="Kuala_Lumpur">Kuala Lumpur</option>
                                        <option value="Labuan">Labuan</option>
                                        <option value="Putrajaya">Putrajaya</option> 
                                    </select>
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control"  name="zipcode" placeholder="Zipcode">
                                </div>
                                <div class="col">
                                    <select class="form-select" name="country">
                                        <option value="Malaysia" selected>Malaysia</option>
                                        <option value="Singapura">Singapura</option>
                                        <option value="Indonesia">Indonesia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <button  type="submit" class="btn btn-primary" name="btn_save_ship">Save Shipping Address</button>
                                </form>
                            </div>     
                        </div>

                    <?php
                        //end else if
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col">
        <span style="font-size: 13px;">Billing address</span>
        <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
            <div class="ms-5 me-5">
                <!-- Enter Bill Address -->
                <?php
                //Check if shipping address already add into database
                $query_check_bill = mysqli_query($con,"SELECT * FROM billing_address WHERE FK_BillAdd_Cust_ID = $loginId");
                $result_bill = mysqli_fetch_array($query_check_bill);
                
                if($result_bill>0){
                ?>
                    
                    <div class="col mb-3">
                        <form method="POST">
                        <div class="row">
                            <textarea style="height:100px" class="form-control" name="bill_address" placeholder="Enter address"><?php echo $result_bill['address'] ?></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input class="form-control"  type="text" name="bill_city" value="<?php echo $result_bill['city'] ?>" placeholder="City Name">
                            </div>
                            <div class="col">
                                <select class="form-select" name="bill_state">
                                    <option value="Selangor" <?php if($result_bill['state']=='Selangor'){echo 'selected';} ?>>Selangor</option>
                                    <option value="Johor" <?php if($result_bill['state']=='Johor'){echo 'selected';} ?>>Johor</option>
                                    <option value="Kedah" <?php if($result_bill['state']=='Selangor'){echo 'Kedah';} ?>>Kedah</option>
                                    <option value="Kelantan" <?php if($result_bill['state']=='Selangor'){echo 'Kelantan';} ?>>Kelantan</option>
                                    <option value="Malacca" <?php if($result_bill['state']=='Malacca'){echo 'selected';} ?>>Malacca</option>
                                    <option value="Pahang" <?php if($result_bill['state']=='Pahang'){echo 'selected';} ?>>Pahang</option>
                                    <option value="Penang" <?php if($result_bill['state']=='Penang'){echo 'selected';} ?>>Perak</option>
                                    <option value="Perlis" <?php if($result_bill['state']=='Perlis'){echo 'selected';} ?>>Perlis</option>
                                    <option value="Sabah" <?php if($result_bill['state']=='Sabah'){echo 'selected';} ?>>Sabah</option>
                                    <option value="Sarawak" <?php if($result_bill['state']=='Sarawak'){echo 'selected';} ?>>Sarawak</option>
                                    <option value="Terengganu" <?php if($result_bill['state']=='Terengganu'){echo 'selected';} ?>>Terengganu</option>
                                    <option value="Kuala_Lumpur" <?php if($result_bill['state']=='Kuala_Lumpur'){echo 'selected';} ?>>Kuala Lumpur</option>
                                    <option value="Labuan" <?php if($result_bill['state']=='Labuan'){echo 'selected';} ?>>Labuan</option>
                                    <option value="Putrajaya" <?php if($result_bill['state']=='Putrajaya'){echo 'selected';} ?>>Putrajaya</option> 
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control"  name="bill_zipcode" value="<?php echo $result_bill['zipcode'] ?>" placeholder="Zipcode">
                            </div>
                            <div class="col">
                                <select class="form-select" name="bill_country">
                                    <option value="Malaysia" <?php if($result_bill['country']=='Malaysia'){echo 'selected';} ?>>Malaysia</option>
                                    <option value="Singapura" <?php if($result_bill['country']=='Singapura'){echo 'selected';} ?>>Singapura</option>
                                    <option value="Indonesia" <?php if($result_bill['country']=='Indonesi'){echo 'selected';} ?>>Indonesia</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <input type="hidden" value="<?php echo $result_bill['BillAdd_ID'] ?>" name="bill_id">
                            <button type="submit" class="btn btn-primary" name="btn_update_bill">Save Billing Address</button>
                            </form>
                        </div>     
                    </div>


                <?php }else{
                ?>
                <!-- Enter Shipping Address -->

                    <div class="col mb-3">
                    <form method="POST">
                        <div class="row">
                            <textarea style="height:100px" class="form-control" name="bill_address" placeholder="Enter address"></textarea>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input class="form-control"  type="text" name="bill_city" placeholder="City Name">
                            </div>
                            <div class="col">
                                <select class="form-select" name="bill_state">
                                    <option value="Selangor" selected>Selangor</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Penang">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Kuala_Lumpur">Kuala Lumpur</option>
                                    <option value="Labuan">Labuan</option>
                                    <option value="Putrajaya">Putrajaya</option> 
                                </select>
                            </div>
                            <div class="col">
                                <input type="number" class="form-control"  name="bill_zipcode" placeholder="Zipcode">
                            </div>
                            <div class="col">
                                <select class="form-select" name="bill_country">
                                    <option value="Malaysia" selected>Malaysia</option>
                                    <option value="Singapura">Singapura</option>
                                    <option value="Indonesia">Indonesia</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <button type="submit" class="btn btn-primary" name="btn_save_bill">Save Billing Address</button>
                            </form>
                        </div>     
                    </div>
            </div>
                <?php
                    //end else if
                    }
                ?>
        </div>
    </div>
</div>
<?php
if(isset($_POST['btn_save_ship'])){
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $country = $_POST['country'];
    $query_ship = mysqli_query($con,"INSERT INTO shipping_address(address, city,state, zipcode, country, FK_ShipAdd_Cust_ID) 
    VALUES ('$address','$city','$state','$zipcode','$country','$loginId')");

    //clear post request
    echo '<script>window.location.href="address.php?msg=success"</script>';
}
//End enter shipping address
?>
<?php
if(isset($_POST['btn_save_bill'])){
    $bill_address = $_POST['bill_address'];
    $bill_city = $_POST['bill_city'];
    $bill_state = $_POST['bill_state'];
    $bill_zipcode = $_POST['bill_zipcode'];
    $bill_country = $_POST['bill_country'];
    $query_bill = mysqli_query($con,"INSERT INTO `billing_address`(address, city, state, zipcode, country, FK_BillAdd_Cust_ID) 
    VALUES ('$bill_address','$bill_city','$bill_state','$bill_zipcode','$bill_country',$loginId)");
    //clear post request
    echo '<script>window.location.href="address.php?msg=success"</script>';
}
//End enter bill address
?>
<?php
if(isset($_POST['btn_update_ship'])){
    $ship_id = $_POST['ship_id'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];
    $country = $_POST['country'];
    $query_ship = mysqli_query($con,"UPDATE shipping_address SET 
    address='$address',city='$city',state='$state',zipcode='$zipcode',country='$country' WHERE ShipAdd_ID = '$ship_id'");

    //clear post request
    echo '<script>window.location.href="address.php?msg=success"</script>';
}
?>
<?php
if(isset($_POST['btn_update_bill'])){
    $bill_id = $_POST['bill_id'];
    $bill_address = $_POST['bill_address'];
    $bill_city = $_POST['bill_city'];
    $bill_state = $_POST['bill_state'];
    $bill_zipcode = $_POST['bill_zipcode'];
    $bill_country = $_POST['bill_country'];
    $query_bill = mysqli_query($con,"UPDATE billing_address SET 
    address='$bill_address',city='$bill_city',state='$bill_state',zipcode='$bill_zipcode',country='$bill_country' WHERE BillAdd_ID = '$bill_id'");
    //clear post request
    echo '<script>window.location.href="address.php?msg=success"</script>';
}
//End enter bill address
?>








<?php include("Interface/footer.php")?>