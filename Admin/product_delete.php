<?php
include('../includes/connect_database.php');
include "header.php"; 
if(!isset($_REQUEST['id'])) {
    header('location:view_products.php');
	exit;
} else {
    $id = $_GET['id'];  
    $query = "delete FROM `giohang` WHERE MASP='$id'";
    mysqli_query($con, $query);

    $select_query = "SELECT SOHD FROM CTHD WHERE MASP = '$id'";
    $result_query1 = mysqli_query($con, $select_query);

    $query = "delete FROM `cthd` WHERE MASP='$id'";
    mysqli_query($con, $query);
    
    while ($row = mysqli_fetch_assoc($result_query1)){
        $sohd=$row['SOHD'];
        $query = "delete FROM `cthd` WHERE SOHD= '$sohd'";
        mysqli_query($con, $query);
        $query = "delete FROM `hoadon` WHERE SOHD= '$sohd'";
        mysqli_query($con, $query);  
    }

    $query="delete FROM `sanpham` WHERE MASP='$id'";
    mysqli_query($con, $query);

    mysqli_close($con);
    header('location:view_products.php');
}
?>