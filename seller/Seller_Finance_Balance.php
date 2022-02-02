<?php include("Interface/header.php"); ?>
<?php 
    $Seller_ID = $_SESSION['Seller_Id'];
    $query_seller = mysqli_query($con,"SELECT * FROM seller WHERE Seller_ID = '$Seller_ID'");
    $result_seller = mysqli_fetch_array($query_seller);
    $bank_name = $result_seller['Seller_BankAccName'];

    //Get Wallet Amount
    $query_wallet = mysqli_query($con,"SELECT * FROM wallet WHERE FK_Wallet_Seller_ID = '$Seller_ID'");
    $result_wallet = mysqli_fetch_array($query_wallet);
    $wallet_amount = $result_wallet['Wallet_Amount'];
    $wallet_ID = $result_wallet['Wallet_ID'];


?>
<?php include("Message_Notification.php"); ?>

<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3">
            <div class="d-flex flex-row">
                <div class=""><center><i style="font-size: 40px; color: rgb(99, 157, 243);" class="bi bi-wallet"></i></center></div>
                <div class="text-start ms-3">
                    <span style="font-size: 23px;font-weight: bold;">Balance Overview</span> <br/>
                    <span style="font-size: 14px; color: grey;">Manage your Wallet</span>
                </div>
            </div>
        </div>
        <span class="d-grid mx-auto mt-3 mb-3" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
        <div class="row pt-2 ps-5 pe-5">
            <div class="col-10 p-2">
                <div class="row">
                    <span class="float-start">Wallet Balance</span>
                </div>
                <div class="row pt-2">
                    <div class="d-flex justify-content-start">
                        <div class="fw-bold fs-3">RM<?php echo $wallet_amount; ?></div>
                        <div class="ps-3"><button type="button" data-bs-toggle="modal" data-bs-target="#withdraw" class="btn btn-primary">Withdraw</button></div>
                    </div>
                </div>
            </div>
            <div class="col-2 p-2">
            <div class="row">
                    <span class="float-start fw-bold">My Bank Account</span>
                </div>
                <div class="row pt-2">
                    <div class="d-flex justify-content-start">
                        <div>
                            <?php
                                if($bank_name=='islam'){echo 'Bank Islam';}
                                elseif($bank_name=='maybank'){echo 'Maybank';}
                                elseif($bank_name=='cimb'){echo 'CIMB';}
                                elseif($bank_name=='public'){echo 'Public Bank Bhd';}
                                elseif($bank_name=='hongleong'){echo 'Hong Leong';}
                                elseif($bank_name=='ambank'){echo 'Ambank Group';}
                                elseif($bank_name=='uob'){echo 'United Overseas Bank';}
                                elseif($bank_name=='rakyat'){echo 'Bank Rakyat';}
                                elseif($bank_name=='ocbc'){echo 'OCBC Bank';}
                                elseif($bank_name=='hsbc'){echo 'HSBC Bank Malaysia';}
                                elseif($bank_name=='rhb'){echo 'RHB';}
                            ?>
                            (<?php echo $result_seller['Seller_BankAccNo']; ?>)    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 bg-white shadow-sm p-3 mb-5 bg-body rounded me-5">
        <div class="row p-3 fw-bold fs-5">Transaction</div>
        <div class="row p-3">
            <table id="example" class="display center" style="width: 100%; text-align: center;">
                <thead>
                    <tr>
                        <th>Stats</th>
                        <th>Transaction ID</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query_trans = mysqli_query($con,"SELECT * FROM transaction WHERE FK_Transaction_Seller_ID = '$Seller_ID'");
                        while($result_trans = mysqli_fetch_array($query_trans)){         
                    ?>
                    <tr>
                        <td>                            
                            <?php
                                if($result_trans['Transaction_Type']=='income'){
                                    echo "<i class='bi bi-arrow-up-circle-fill text-success'></i>"; 
                                }elseif($result_trans['Transaction_Type']=='withdraw'){
                                    echo "<i class='bi bi-arrow-down-circle-fill text-danger'></i>";
                                }

                            ?>
                        </td>
                        <td>#<?php echo $result_trans['Transaction_ID']; ?></td>
                        <td><?php echo $result_trans['Transaction_Type']; ?></td>
                        <td><?php echo $result_trans['Transaction_Date']; ?></td>
                        <td><?php echo $result_trans['Transaction_Time']; ?></td>
                        <td>
                            <?php
                                if($result_trans['Transaction_Type']=='income'){
                                    echo "<span class='text-success'>RM".$result_trans['Transaction_Amount']."</span>"; 
                                }elseif($result_trans['Transaction_Type']=='withdraw'){
                                    echo "<span class='text-danger'>RM".$result_trans['Transaction_Amount']."</span>";
                                }

                            ?>
                        </td>
                        <td><?php echo $result_trans['Transaction_Status']; ?></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Winthdraw -->
<div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="editModalLabel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Withdrawal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group row">
              <div class="col">
                <form method="post">
                <div class="mb-3">
                    <label class="form-label">Enter Withdrawal Amount</label>
                    <input type="number" class="form-control" name="amount">
                </div>
              </div>    
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="withdrawalBtn">Withdraw</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
        </div>   
      </div>
    </div>
</div>

<?php
    if(isset($_POST['withdrawalBtn'])){
        echo $amount = $_POST['amount'];
        if($amount>$wallet_amount){
            $_SESSION['messageErr'] = 'Please Enter Amount less than wallet balance';
            echo '<script>window.location.href="Seller_Finance_Balance.php"</script>';
        }elseif($amount<=0){
            $_SESSION['messageErr'] = 'Please Enter Amount not less than 0';
            echo '<script>window.location.href="Seller_Finance_Balance.php"</script>';
        }else{
            $newAmount = $wallet_amount - $amount;
            $query_updateWallet = mysqli_query($con,"UPDATE wallet SET Wallet_Amount='$newAmount' WHERE FK_Wallet_Seller_ID = '$Seller_ID'");

            //New Transaction
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $todayDate = date('d-m-Y');
            $todayTime = date('h:i:s a');
            $NullOrder_ID = 0;
            $query_newTransaction = mysqli_query($con,"INSERT INTO transaction(Transaction_Date, Transaction_Time, Transaction_Type, Transaction_Amount, Transaction_Status, FK_Transaction_Wallet_ID, FK_Transaction_Seller_ID, FK_Transaction_Order_ID) 
            VALUES ('$todayDate','$todayTime','withdraw','$amount','completed','$wallet_ID','$Seller_ID','$NullOrder_ID')");
            $_SESSION['message'] = 'Successfully withdraw RM'.$amount.' from wallet';
            echo '<script>window.location.href="Seller_Finance_Balance.php"</script>';
        }

    }
?>

<?php include("Interface/footer.php"); ?>