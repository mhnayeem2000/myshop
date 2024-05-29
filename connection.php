<?php
    $con = mysqli_connect("localhost", "root","","myshop");

if($con == false){
    die("Error connecting to database " . mysqli_connect_error());
}
?>