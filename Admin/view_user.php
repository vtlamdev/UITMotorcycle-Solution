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
        <title>List user</title>
    </head>

    <body>
        <?php

    ?>
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="products" class="table table-striped table-hover" role="grid"
                            aria-describedby="products_info">
                            <thead class="thead-dark">
                                <tr role="row" style='text-align:center'>
                                    <th width="160" scope="col">
                                        Mã khách hàng</th>
                                    <th width="160" scope="col">
                                        Tên khách hàng</th>
                                    <th width="160" scope="col">
                                        Địa chỉ</th>
                                    <th width="160" scope="col">
                                        Số điện thoại</th>
                                    <th width="160" scope="col">
                                        Email</th>
                                    <th width="160" scope="col">
                                        Ngày sinh</th>
                                    <th width="160" scope="col">
                                        Ngày đăng ký</th>
                                    <th width="160" scope="col">
                                        Số dư</th>
                                    <th width="160" scope="col">
                                        Giới tính</th>
                                    <th width="160" scope="col">
                                        Số CCCD</th>
                                    <th width="160" scope="col">
                                        Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $select_query = "SELECT * FROM KHACHHANG, TAIKHOAN WHERE KHACHHANG.MAKH = TAIKHOAN.MAKH AND is_admin = 0 ORDER BY KHACHHANG.MAKH";
                            $result_query = mysqli_query($con, $select_query);

                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $makh = $row['MAKH'];
                                $hoten = $row['HOTEN'];
                                $diachi = $row['DCHI'];
                                $sdt = $row['SODT'];
                                $email = $row['email'];
                                $ngsinh = $row['NGSINH'];
                                $ngdk = $row['NGDK'];
                                $sodu = $row['SODU'];
                                $cccd = $row['SOCCCD'];
                                $gioitinh = $row['GIOITINH'];
                                echo "<tr style='text-align:center'>";
                                echo "<td style='text-align:left'>";
                                echo $makh;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $hoten;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $diachi;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $sdt;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $email;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $ngsinh;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $ngdk;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo currency_format($sodu) . " đ";
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $gioitinh;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $cccd;
                                echo "</td>";
                                echo "<td><a href='user_delete.php?id=$makh' style='text-decoration: none; color:red'>Delete</a></td>";
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