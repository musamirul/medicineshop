<?php
    session_start();
    include("../includes/config.php");
    if($_SESSION['username']=="" || $_SESSION['role']!="customer"){
        session_unset();
        header("location:../login.php");
    }
?>
<form enctype="multipart/form-data" method="post">
    Select File
    <input type="file" name="file"/>
    <input type="text" name="fileName" placeholder="Enter File Type" />
    <button type="submit" name="submit">Submit</button>
</form>


<table>
    <thead>
        <tr>
            <th>Type</th>
            <th>Files</th>
            <th>Action</th>
        </thead>
<?php
    $query_showDoc = mysqli_query($con,"SELECT * FROM declaration WHERE FK_Declaration_Cust_ID = '$Cust_Id'");
    while($result_showDoc = mysqli_fetch_array($query_showDoc)){
        $name = $result_showDoc['Declaration_FileName'];   
?>
    <tbody>
        <tr>
            <td><?php echo $result_showDoc['Declaration_Name']?></td>
            <td><?php echo $name; ?></td>
            <td><a href="cust_declaration-download.php?filename=<?php echo $name;?>&f=<?php echo $result_showDoc['Declaration_File']?>"><button>Download</button></a></td>
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
    $fileName = $_POST['fileName'];


    //get date and time
    date_default_timezone_set("Asia/Kuala_Lumpur");
    $date = date("Y-m-d h:i:sa");

    $fname = date("YmdHis").'_'.$name;
    $move = move_uploaded_file($temp,"upload/".$fname);
    
    $query_uploadFile=mysqli_query($con,"INSERT INTO declaration(Declaration_Name, Declaration_FileName, Declaration_File, Declaration_TimeStamp, FK_Declaration_Cust_ID) 
    VALUES ('$fileName','$name','$fname','$date','$Cust_Id')");

    header("Location:cust_declaration-upload.php?msg=success");
    
}
?>