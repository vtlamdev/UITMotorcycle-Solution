<?php
include('../includes/connect_database.php');
include "header.php";
if (!isset($_REQUEST['id'])) {
    header('location:view_user.php');
    exit;
} else {
    $id = $_GET['id'];
    $query = "delete FROM `naptien` WHERE MAKH=$id";
    $result_query = mysqli_query($con, $query);

    $query = "delete FROM `taikhoan` WHERE MAKH=$id";
    $result_query = mysqli_query($con, $query);

    $query = "delete FROM `giohang` WHERE MAKH=$id";
    $result_query = mysqli_query($con, $query);

    $select_query = "SELECT * FROM `hoadon` WHERE MAKH=$id";
    $result_query1 = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query1)){
        $sohd=$row['SOHD'];
        $query = "delete FROM `cthd` WHERE SOHD= $sohd";
        $result_query = mysqli_query($con, $query);
    }
    $query = "delete FROM `hoadon` WHERE MAKH=$id";
    $result_query = mysqli_query($con, $query);
    $query = "delete FROM `khachhang` WHERE MAKH=$id";
    $result_query = mysqli_query($con, $query);
    mysqli_close($con);
    echo "<script>alert('Đã xóa người dùng thành công!!!')</script>";
    echo "<script>window.location='view_user.php' </script>";
}
?>