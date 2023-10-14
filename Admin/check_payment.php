<?php
include('../includes/connect_database.php');
include "header.php";
include('../function/currency_format.php');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="products" class="table table-striped table-hover" role="grid"
                            aria-describedby="products_info">
                            <thead class="thead-dark">
                                <tr role="row" style='text-align:center'>
                                    <th width="100" scope="col">Mã nạp tiền</th>
                                    <th width="160" scope="col">
                                        Mã khách hàng</th>
                                    <th width="160" scope="col">
                                        Tên khách hàng</th>
                                    <th width="160" scope="col">
                                        Số tiền</th>
                                    <th width="160" scope="col">
                                        Ngày nạp</th>
                                    <th width="160" scope="col">
                                        Số tài khoản</th>
                                    <th width="160" scope="col">
                                        Đã duyệt(0: chưa duyệt; 1: đã duyệt)</th>
                                    <th width="160" scope="col">
                                        Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $select_query = "SELECT * FROM NAPTIEN";
                            $result_query = mysqli_query($con, $select_query);

                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $manaptien = $row['MANAPTIEN'];
                                $makh = $row['MAKH'];
                                $select_kh="SELECT * FROM KHACHHANG, NAPTIEN WHERE KHACHHANG.MAKH=$makh";
                                $result_kh=mysqli_query($con, $select_kh);
                                $rowkh=mysqli_fetch_assoc($result_kh);
                                $tenkh=$rowkh['HOTEN'];
                                $sotien = $row['SOTIEN'];
                                $ngaynap = $row['NGAYNAP'];
                                $sotaikhoan = $row['SOTAIKHOAN'];
                                $daduyet = $row['DADUYET'];
                                echo "<tr style='text-align:center'>";
                                echo "<td style='text-align:left'>";
                                echo $manaptien;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $makh;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $tenkh;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo currency_format($sotien) . " đ";
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $ngaynap;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $sotaikhoan;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $daduyet;
                                echo "</td>";
                                if($daduyet == 0){
                                    echo "<td><form method='GET'><a style='text-decoration: none' href='add_money.php?id=$manaptien'>DUYỆT</a></form></td>";
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>