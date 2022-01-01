<?php
session_start();
include('../includes/config.php');
if($_SESSION['role']!="administrator"){
    session_unset();
    header("Location:../login.php");
}
?>

<Table style="border: 1px solid black;">
    <thead>
        <th>No</th>
        <th>ID</th>
        <th>Name</th>
        <th>Reg No</th>
        <th>Phone No</th>
        <th>Address</th>
        <th>Bank Name</th>
        <th>Bank No</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
<?php
    //display all table data
    $query_showData = mysqli_query($con,"SELECT * FROM seller");
    $count = 1;
    while($result_showData = mysqli_fetch_array($query_showData)){
?>
    <tbody>
        <td><?php echo $count ?></td>
        <td><?php echo $result_showData['Seller_ID']; ?></td>
        <td><?php echo $result_showData['Seller_Name']; ?></td>
        <td><?php echo $result_showData['Seller_RegistrationNo']; ?></td>
        <td><?php echo $result_showData['Seller_Phone']; ?></td>
        <td><?php echo $result_showData['Seller_Address']; ?></td>
        <td><?php echo $result_showData['Seller_BankAccName']; ?></td>
        <td><?php echo $result_showData['Seller_BankAccNo']; ?></td>
        <td><?php echo $result_showData['Seller_Registration_Status']; ?></td>
        <td><a href="Admin_ManageSeller-edit.php?id=<?php echo $result_showData['Seller_ID']?>"><button value="submit">Edit</button></a></td>
    </tbody>
<?php
    $count++;
    }
?>
</Table>