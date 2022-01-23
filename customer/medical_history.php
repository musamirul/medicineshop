<?php include("Interface/header.php")?>
<?php
 session_start();
 include("../includes/config.php");
 if($_SESSION['id']==""){
    header("location:../login.php");
 }
 $_SESSION['id'];
 $_SESSION['username'];
 $_SESSION['role'];
 $Cust_ID =  $_SESSION['Cust_Id'];
 $current_file_name = basename($_SERVER['PHP_SELF']); 
?>
<div class="row">
        <div class="col-2 background-color:black;"></div>
        <!-- Left Navigation -->
        <div class="col-2">
            <?php include("Interface/sidebar.php") ?>
        </div>
        <div class="col-6 bg-white">
            <div class="m-3">
                <h5>Medical History</h5>
                <span style="font-size: 13px;">Manage and protect your medical history</span>
                <span class="d-grid mx-auto mt-3 mb-4" style="border-bottom:0.5px solid rgb(241, 240, 240);"></span>
                <div class="ms-5 me-5">
                <!-- form that have result -->
                    <?php
                        $query_check = mysqli_query($con,"SELECT * FROM medical_history WHERE FK_Med_Cust_ID = '$Cust_ID'");
                        $result_check = mysqli_fetch_array($query_check);
                        if($result_check>0){
                    ?>
                    <form method="post">
                        <div class="row mb-3">
                            <div class="col">
                            <?php if($result_check['Blood_Group']=="A+") {  ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+" selected>A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select> 
                            <?php }elseif($result_check['Blood_Group']=="A-") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-" selected>A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select>
                            <?php }elseif($result_check['Blood_Group']=="B+") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-">A-</option>
                                    <option value="B+" selected>B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select>
                            <?php }elseif($result_check['Blood_Group']=="B-") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-" selected>B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select>
                            <?php }elseif($result_check['Blood_Group']=="AB+") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+" selected>AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select>
                            <?php }elseif($result_check['Blood_Group']=="AB-") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-" selected>AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select>
                            <?php }elseif($result_check['Blood_Group']=="O+") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+" selected>O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select>
                            <?php }elseif($result_check['Blood_Group']=="O-") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-" selected>O-</option>
                                    <option value="Others">Others</option>
                                </select>
                            <?php }elseif($result_check['Blood_Group']=="Others") { ?>
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+">A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others" selected>Others</option>
                                </select>
                            <?php }?>
                            </div>
                            <div class="col">
                                <label class="col-form-label">Weight</label>
                                <div class="col-sm-10">
                                    <input type="number" placeholder="Enter Weight in kg" class="form-control" name="Weight" value="<?php echo $result_check['Weight'] ?>"/>
                                </div>
                            </div>
                            <div class="col">
                            <label class="col-form-label">Height</label>
                                <div class="col-sm-10">
                                    <input type="number" placeholder="Enter Weight in kg" class="form-control" name="Height" value="<?php echo $result_check['Height'] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                            <?php if($result_check['Alcohol']=="yes") {?>
                                <div class="row">
                                    <label class="col-form-label">Do you drink Alcohol?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Alcohols" value="yes" checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="Alcohols" value="no">
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            <?php } elseif($result_check['Alcohol']=="no") {?>
                                <div class="row">
                                    <label class="col-form-label">Do you drink Alcohol?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Alcohols" value="yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input class="form-check-input" type="radio" name="Alcohols" value="no" checked>
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            <?php } elseif($result_check['Alcohol']=="") {?>
                                <div class="row">
                                    <label class="col-form-label">Do you drink Alchohol?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Alcohols" value="yes" checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input class="form-check-input" type="radio" name="Alcohols" value="no">
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            <?php }?>
                            </div>
                            <div class="col">
                            <?php if($result_check['Smoking']=="yes") {?>
                                <div class="row">
                                    <label class="col-form-label">Do you Smoking?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Smokings" value="yes" checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="Smokings" value="no">
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            <?php } elseif($result_check['Smoking']=="no") {?>
                                <div class="row">
                                    <label class="col-form-label">Do you Smoking?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Smokings" value="yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input class="form-check-input" type="radio" name="Smokings" value="no" checked>
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            <?php } elseif($result_check['Smoking']=="") {?>
                                <div class="row">
                                    <label class="col-form-label">Do you Smoking?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Smokings" value="yes">
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input class="form-check-input" type="radio" name="Smokings" value="no" checked>
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            <?php }?>
                            </div>
                            <div class="col">
                                <?php if($result_check['Exercise']=="yes") {?>
                                    <div class="row">
                                        <label class="col-form-label">Do you Exercise regularly?</label>
                                        <div class="form-check ms-5">                
                                            <input class="form-check-input" type="radio" name="Exercises" value="yes" checked>
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check ms-5">
                                            <input type="radio" class="form-check-input" name="Exercises" value="no">
                                            <label class="form-check-label">No</label>
                                            
                                        </div>
                                    </div>
                                <?php } elseif($result_check['Exercise']=="no") {?>
                                    <div class="row">
                                        <label class="col-form-label">Do you Exercise regularly?</label>
                                        <div class="form-check ms-5">                
                                            <input class="form-check-input" type="radio" name="Exercises" value="yes">
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="Exercises" value="no" checked>
                                            <label class="form-check-label">No</label>
                                            
                                        </div>
                                    </div>
                                <?php } elseif($result_check['Smoking']=="") {?>
                                    <div class="row">
                                        <label class="col-form-label">Do you Exercise regularly?</label>
                                        <div class="form-check ms-5">                
                                            <input class="form-check-input" type="radio" name="Exercises" value="yes">
                                            <label class="form-check-label">Yes</label>
                                        </div>
                                        <div class="form-check ms-5">
                                            <input class="form-check-input" type="radio" name="Exercises" value="no" checked>
                                            <label class="form-check-label">No</label>
                                            
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating">
                                <textarea style="height: 100px" class="form-control" name="Illness" placeholder="Enter your past and current illness here" id="floatingTextarea"><?php echo $result_check['Illness']; ?></textarea>
                                <label>Past and current illness</label>
                              </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-floating">
                                <textarea style="height: 100px" class="form-control" name="Surgery" placeholder="Enter your past and current surgery here" id="floatingTextarea"><?php echo $result_check['Surgery']; ?></textarea>
                                <label>Past and current Surgery</label>
                              </div>
                        </div>
                        <div class="row mt-4 mb-5">
                            <button class="btn btn-primary" name="save_history" type="submit">Save</button>
                        </div>
                    </form>
                    <?php } else{?>
                    <!--form that doesnt have result -->
                    <form method="post">
                        <div class="row mb-3">
                            <div class="col">
                                <label class="col-form-label">Blood Group</label>
                                <select class="form-select" name="Blood_Group">
                                    <option value="A+" selected>A+</option><option value="A-">A-</option>
                                    <option value="B+">B+</option><option value="B-">B-</option>
                                    <option value="AB+">AB+</option><option value="AB-">AB-</option>
                                    <option value="O+">O+</option><option value="O-">O-</option>
                                    <option value="Others">Others</option>
                                </select> 
                            </div>
                            <div class="col">
                                <label class="col-form-label">Weight</label>
                                <div class="col-sm-10">
                                    <input type="number" placeholder="Enter Weight in kg" class="form-control" name="Weight" value="<?php echo $result_check['Weight'] ?>"/>
                                </div>
                            </div>
                            <div class="col">
                            <label class="col-form-label">Height</label>
                                <div class="col-sm-10">
                                    <input type="number" placeholder="Enter Weight in kg" class="form-control" name="Height" value="<?php echo $result_check['Height'] ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="row">
                                    <label class="col-form-label">Do you drink Alchohol?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Alcohols" value="yes" checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="Alcohols" value="no">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label class="col-form-label">Do you Smoking?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Smokings" value="yes" checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="Smokings" value="no">
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label class="col-form-label">Do you Exercise regularly?</label>
                                    <div class="form-check ms-5">                
                                        <input class="form-check-input" type="radio" name="Exercises" value="yes" checked>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check ms-5">
                                        <input type="radio" class="form-check-input" name="Exercises" value="no">
                                        <label class="form-check-label">No</label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-floating">
                                <textarea style="height: 100px" class="form-control" name="Illness" placeholder="Enter your past and current illness here" id="floatingTextarea"></textarea>
                                <label>Past and current illness</label>
                              </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-floating">
                                <textarea style="height: 100px" class="form-control" name="Surgery" placeholder="Enter your past and current surgery here" id="floatingTextarea"></textarea>
                                <label>Past and current Surgery</label>
                              </div>
                        </div>
                        <div class="row mt-4 mb-5">
                            <button class="btn btn-primary" name="save_history" type="submit">Save</button>
                        </div>
                    </form>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
</div>


<!--
<h1>Medical History</h1>
<form method="post">
<select name="Blood_Group">
    <option value="A+" selected>A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
    <option value="Others">Others</option>
</select>
<input type="number" name="Weight" placeholder="Enter Weight in kg"/>
<input type="number" name="Height" placeholder="Enter Height in cm"/>
<br/>Do you drink Alchohol?
<input type="radio" name="Alcohol" checked value="yes">yes
<input type="radio" name="Alcohol" value="no">no
<br/>Do you Smoking?
<input type="radio" name="Smoking" checked value="yes">yes
<input type="radio" name="Smoking" value="no">no
<br/>Do you Exercise regulary?
<input type="radio" name="Exercise" checked value="yes">yes
<input type="radio" name="Exercise" value="no">no
<br/>
<textarea rows="5" cols="50" name="illness" placeholder="Enter your past and current illness"></textarea><br/>
<textarea rows="5" cols="50" name="Surgery" placeholder="Enter your past and current surgery"></textarea><br/>
<button type="submit" name="save_history">Save</button>
</form>-->
<?php
    
    if(isset($_POST['save_history'])){
        $blood = $_POST['Blood_Group'];
        $weight = $_POST['Weight'];
        $height = $_POST['Height'];
        $alcohol = $_POST['Alcohols'];
        $smoking = $_POST['Smokings'];
        $exercise = $_POST['Exercises'];
        $illness = $_POST['Illness'];
        $surgery = $_POST['Surgery'];
        
        $height_meter = $height/100;
        $bmi = round($weight/($height_meter*$height_meter),2);

        $query_check_ID = mysqli_query($con,"SELECT * FROM medical_history WHERE FK_Med_Cust_ID = '$Cust_ID'");
        $query_check_result = mysqli_fetch_array($query_check_ID);
        if($query_check_result['FK_Med_Cust_ID']==""){

            $query_hist = mysqli_query($con,"INSERT INTO medical_history(Blood_Group, Weight, Height, Alcohol, Smoking, Exercise, Illness, BMI, Surgery, FK_Med_Cust_ID) 
            VALUES ('$blood','$weight','$height','$alcohol','$smoking','$exercise','$illness','$bmi','$surgery','$Cust_ID')");
            echo '<script>window.location.href="medical_history.php"</script>';
        }else{
            $query_hist_update = mysqli_query($con,"UPDATE medical_history SET Blood_Group='$blood',Weight='$weight',Height='$height',Alcohol='$alcohol',
            Smoking='$smoking',Exercise='$exercise',Illness='$illness',BMI='$bmi',Surgery='$surgery' WHERE FK_Med_Cust_ID = '$Cust_ID'");
            echo '<script>window.location.href="medical_history.php"</script>';
        }


        
        
    }
?>
<?php include("Interface/footer.php")?>