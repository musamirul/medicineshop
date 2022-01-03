<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['username']=="" || $_SESSION['role']!="customer"){
        session_unset();
        header("location:../login.php");
    }
    $Cust_Id = $_SESSION['Cust_Id'];
?>

<form enctype="multipart/form-data" method="post">
    Select File
    <input type="file" name="file"/>
    <button type="submit" name="submit">Submit</button>
</form>

<table>
    <thead>
        <tr>
            <th>Files</th>
            <th>Action</th>
        </tr>
    </thead>
<?php
    $query_showDoc = mysqli_query($con,"SELECT * FROM record WHERE FK_Record_Cust_ID = '$Cust_Id'");
    while($result_showDoc = mysqli_fetch_array($query_showDoc)){
        $name = $result_showDoc['Record_FileName'];   
?>
    <tbody>
        <tr>
            <td><?php echo $name; ?></td>
            <td><a href="cust_declaration-download.php?filename=<?php echo $name;?>&f=<?php echo $result_showDoc['Record_File']?>"><button>Download</button></a></td>
        </tr>
    </tbody>
<?php
    }
?>
</table>
<?php
if(isset($_POST['submit'])){
    $name=$_FILES['file']['name'];
    $size=$_FILES['file']['size'];
    $type=$_FILES['file']['type'];
    $temp=$_FILES['file']['tmp_name'];


    //get date and time
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d h:i:sa");

    $fname = date("YmdHis").'_'.$name;
    $move = move_uploaded_file($temp,"upload/".$fname);
    
    $query_uploadFile=mysqli_query($con,"INSERT INTO record(Record_Timestamp, Record_File, Record_FileName, FK_Record_Product_ID, FK_Record_Cust_ID)
    VALUES ('$date','$fname','$name','0','$Cust_Id')");

    header("Location:cust_record-upload.php?msg=success");
    
}
?>