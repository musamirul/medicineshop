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
?>
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
</form>
<?php
    
    if(isset($_POST['save_history'])){
        $blood = $_POST['Blood_Group'];
        $weight = $_POST['Weight'];
        $height = $_POST['Height'];
        $alcohol = $_POST['Alcohol'];
        $smoking = $_POST['Smoking'];
        $exercise = $_POST['Exercise'];
        $illness = $_POST['illness'];
        $surgery = $_POST['Surgery'];
        
        $height_meter = $height/100;
        $bmi = round($weight/($height_meter*$height_meter),2);

        $query_hist = mysqli_query($con,"INSERT INTO medical_history(Blood_Group, Weight, Height, Alcohol, Smoking, Exercise, Illness, BMI, Surgery, FK_Med_Cust_ID) 
        VALUES ('$blood','$weight','$height','$alcohol','$smoking','$exercise','$illness','$bmi','$surgery','$Cust_ID')");
        
        
    }
?>
