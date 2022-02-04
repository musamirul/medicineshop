<?php
    if(isset($_SESSION['message'])){
        $_SESSION['message'];
        echo "<div class='alert alert-success' role='alert' style='position : absolute; width:500px'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
        . $_SESSION['message'] .
        "</div>";

        unset($_SESSION['message']);
    } 
    if(isset($_SESSION['messageErr'])){
        $_SESSION['messageErr'];
        echo "<div class='alert alert-danger' role='alert' style='position : absolute; width:500px'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
        . $_SESSION['messageErr'] .
        "</div>";

        unset($_SESSION['messageErr']);
    } 
?>