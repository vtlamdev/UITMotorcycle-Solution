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
        <style>
        .grid_thongke {
            padding: 100px;
            display: grid;
            gap: 16px;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .flex_a_thongke {
            display: flex;
            flex-direction: row;
            align-items: center;
            border-radius: 8px;
            padding: 16px;
            text-decoration: none;
        }

        .flex_a_thongke:hover {
            background-color: greenyellow;
        }

        .img_thongke {
            height: 80px;
            width: 80px;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            object-fit: cover;
        }

        .flex_text_thongke {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 16px;
            line-height: 1.5;
        }

        .h5 {
            margin-bottom: 8px;
        }
        </style>
    </head>

    <body>
        <div class="container my-5">
            <h3><i class="fa-solid fa-right-from-bracket"></i>Thống kê</h3>
        </div>
        <div class="row set_row mx-auto my-5 container">
            <div class="col-lg-3 col-xs-6">
                <a href="view_user.php" class="flex_a_thongke ">
                    <img class="img_thongke" src="../Asset/Picture/avatar-svgrepo-com.svg" alt="" />
                    <div class="flex_text_thongke">
                        <h5>Người dùng</h5>
                        <p>
                            <?php
                        $select_query = "SELECT COUNT(*) FROM KHACHHANG, TAIKHOAN WHERE KHACHHANG.MAKH = TAIKHOAN.MAKH AND is_admin = 0";
                        $result_query = mysqli_query($con, $select_query);
                        $row = mysqli_fetch_assoc($result_query);
                        echo $row['COUNT(*)'];
                        ?>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="all_order.php" class="flex_a_thongke">
                    <img class="img_thongke" src="../Asset/Picture/order-placed-purchased-icon.png" alt="" />
                    <div class="flex_text_thongke">
                        <h5>Đơn hàng</h5>
                        <p>
                            <?php
                        $select_query = "SELECT COUNT(*) FROM HOADON";
                        $result_query = mysqli_query($con, $select_query);
                        $row = mysqli_fetch_assoc($result_query);
                        echo $row['COUNT(*)'];
                        ?>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="all_order.php" class="flex_a_thongke">
                    <img class="img_thongke" src="../Asset/Picture/money.png" alt="" />
                    <div class="flex_text_thongke">
                        <h5>Doanh thu</h5>
                        <p>
                            <?php
                        $select_query = "SELECT SUM(TRIGIA) FROM HOADON WHERE TRANGTHAI = 1";
                        $result_query = mysqli_query($con, $select_query);
                        $row = mysqli_fetch_assoc($result_query);
                        echo currency_format($row['SUM(TRIGIA)']) . " đ";
                        ?>
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-xs-6">
                <a href="check_payment.php" class="flex_a_thongke">
                    <img class="img_thongke" src="../Asset/Picture/request.png" alt="" />
                    <div class="flex_text_thongke">
                        <h5>Yêu cầu</h5>
                        <p>
                            <?php
                        $select_query = "SELECT COUNT(*) FROM naptien WHERE DADUYET = 0";
                        $result_query = mysqli_query($con, $select_query);
                        $row = mysqli_fetch_assoc($result_query);
                        echo $row['COUNT(*)'];
                        ?>
                        </p>
                    </div>
                </a>
            </div>
        </div>



        <section class="container pt-3 mt-3 list_brands">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body table-responsive">
                            <div id="admins_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="brands" class="table table-striped table-hover" role="grid"
                                            aria-describedby="brands_info">
                                            <thead class="thead-dark">
                                                <tr role="row" style='text-align:center'>
                                                    <th width="180" scope="col">
                                                        Hãng
                                                    </th>
                                                    <th width="140" scope="col">
                                                        Số lượng sản phẩm bán được</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $select_query = "SELECT TENHANG, COUNT(SANPHAM.MASP) FROM CTHD, SANPHAM, HANGXE WHERE CTHD.MASP = SANPHAM.MASP AND SANPHAM.MAHANG = HANGXE.MAHANG GROUP BY TENHANG;";
                                                $result_query = mysqli_query($con, $select_query);
                                                while ($row = mysqli_fetch_assoc($result_query)) {
                                                    $tenhang = $row['TENHANG'];
                                                    $count = $row['COUNT(SANPHAM.MASP)'];
                                                
                                                ?>

                                                <tr style='text-align:center'>
                                                    <td><?php echo $tenhang; ?></td>
                                                    <td><?php echo $count; ?></td>

                                                </tr>
                                                <?php
                                                    }
                                                
                                                    ?>

                                            </tbody>
                                        </table>
                                        <?php mysqli_close($con); ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>

</html>