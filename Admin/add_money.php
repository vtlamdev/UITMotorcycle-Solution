<?php
    include('../includes/connect_database.php');
    include "header.php";

    $manaptien = $_GET['id'];
    $select_query = "SELECT * FROM NAPTIEN WHERE MANAPTIEN ='$manaptien'";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result_query);
    $makh = $row['MAKH'];
    $sotien = $row['SOTIEN'];
    $daduyet = $row['DADUYET'];
    if ($daduyet == 0) {
        $select_query1 = "SELECT * FROM KHACHHANG WHERE MAKH = $makh";
        $result_query1 = mysqli_query($con, $select_query1);
        $row2 = mysqli_fetch_assoc($result_query1);
        $sodu = $row2['SODU'];
        $sodu += $sotien;
        $select_query2 = "UPDATE KHACHHANG SET SODU = '$sodu' WHERE MAKH = $makh";
        $result_query2 = mysqli_query($con, $select_query2);
        $select_query3 = "UPDATE NAPTIEN SET DADUYET = 1 WHERE MANAPTIEN = '$manaptien'";
        $result_query3 = mysqli_query($con, $select_query3);
        echo "<div class='container text-center'><div class='alert alert-success text-center my-3 mx-auto'>ĐÃ CỘNG TIỀN VÀO TÀI KHOẢN KHÁCH HÀNG!!!</div>";
    }
    else{
        echo "<div class='container text-center'><div class='alert alert-danger text-center my-3 mx-auto'>ĐÃ DUYỆT TRƯỚC ĐÓ!!! THAO TÁC THẤT BẠI!!!</div>";
    }
    echo "<br><a href='check_payment.php' class='p-2' style='text-decoration:none; background-color: #05c5cc;border-radius:5px; color:white'>QUAY LẠI</a></div>"
?>