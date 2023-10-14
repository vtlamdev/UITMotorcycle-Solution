<?php
include('../includes/connect_database.php');
include "header.php";

if(!isset($_REQUEST['id'])) {
    header('location:view_products.php');
	exit;
} else {
    $masp = $_GET['id'];
    $select_query = "SELECT * FROM SANPHAM WHERE MASP = $masp";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result_query);
    if($row['IS_ACTIVE'] == 1)
    {
        $sql = "UPDATE SANPHAM SET IS_ACTIVE = 0 WHERE MASP = $masp";
        $result_query1 = mysqli_query($con, $sql);
    }
    else{
        $sql = "UPDATE SANPHAM SET IS_ACTIVE = 1";
        $result_query1 = mysqli_query($con, $sql); 
    }
    echo "<script>alert('Đã đổi trạng thái thành công!!!') </script>";
    echo "<script>window.location='view_products.php' </script>";
}
?>