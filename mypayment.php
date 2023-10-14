<?php include('./function/currency_format.php'); ?>
<div class="container-fluid border mypayment">
    <h3>Quản lý tài chính <i class="fa-solid fa-credit-card"></i></h3>
    <div class="row my-5 border-top">
        <div class="col-md-6 border-end border-danger info_account">
            <h5>Thông tin số dư tài khoản</h5>
            <div>
                <?php
                $get_tdn = $_SESSION['username'];
                $select_makh = "select * from `taikhoan` where tendangnhap='$get_tdn'";
                $select_makh_run = mysqli_query($con, $select_makh);
                $row = mysqli_fetch_assoc($select_makh_run);
                $makh = $row['MAKH'];
                $select_khachhang = "select * from `khachhang` where MAKH='$makh'";
                $select_khachhang_run = mysqli_query($con, $select_khachhang);
                $row_khachhang = mysqli_fetch_assoc($select_khachhang_run);
                $get_sodu = $row_khachhang['SODU'];
                ?>
                <p>Số dư tài khoản hiện tại:</p>
                <h5 class="text-danger"><?php echo currency_format($get_sodu) . " đ" ?></h5>
                <div class="text-end bottom-0 end-0 d-flex justify-content-end">
                    <a class="bg-success p-2 rounded" href="user.php?payment">Nạp tiền</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h5>Biến động số dư</h5>
            <div class="row" style="overflow-Y:scroll;max-height: 300px;">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" role="grid">
                            <thead class="thead-dark">
                                <tr role="row" style='text-align:center'>
                                    <th width="50" scope="col">
                                        Thời gian</th>
                                    <th width="50" scope="col">
                                        Mô tả</th>
                                    <th width="50" scope="col">
                                        Số tiền</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_hoadon = "SELECT * FROM HOADON WHERE MAKH = '$makh'";
                                $select_hoadon_run = mysqli_query($con, $select_hoadon);
                                while ($row_hoadon = mysqli_fetch_assoc($select_hoadon_run)) {
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $row_hoadon['NGHD'] ?></td>
                                    <td> <?php if($row_hoadon['TRANGTHAI']=='-1'){ echo "Hủy hóa đơn ". $row_hoadon['SOHD'];}else {echo "Thanh toán hóa đơn ". $row_hoadon['SOHD'];} ?>
                                    </td>
                                    <td><?php if($row_hoadon['TRANGTHAI']=='-1'){ echo"+". currency_format($row_hoadon['TRIGIA']) . " đ";}else{echo"-". currency_format($row_hoadon['TRIGIA']) . " đ";} ?>
                                    </td>
                                </tr>
                                <?php
                                }
                                $select_naptien = "SELECT * FROM NAPTIEN WHERE MAKH = '$makh' AND DADUYET = 1";
                                $select_naptien_run = mysqli_query($con, $select_naptien);
                                while ($row_naptien = mysqli_fetch_assoc($select_naptien_run)) {
                                ?>
                                <tr class="text-center">
                                    <td><?php echo $row_naptien['NGAYNAP'] ?></td>
                                    <td>Nạp tiền thành công</td>
                                    <td><?php echo"+". currency_format($row_naptien['SOTIEN']) . " đ" ?></td>

                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="">
        <h5>Lịch sử nạp tiền</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" role="grid">
                        <thead class="thead-dark">
                            <tr role="row" style='text-align:center'>
                                <th width="50" scope="col">
                                    Mã nạp tiền</th>
                                <th width="250" scope="col">
                                    Ngày nạp</th>
                                <th width="160" scope="col">
                                    Số tài khoản</th>
                                <th width="160" scope="col">
                                    Số tiền</th>
                                <th width="120" scope="col">
                                    Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $select_naptien = "select * from `naptien` where MAKH='$makh'";
                            $select_naptien_run = mysqli_query($con, $select_naptien);
                            while ($row_naptien = mysqli_fetch_assoc($select_naptien_run)) {
                            ?>

                            <tr class="text-center">
                                <td><?php echo $row_naptien['MANAPTIEN'] ?></td>
                                <td><?php echo $row_naptien['NGAYNAP'] ?></td>
                                <td><?php echo $row_naptien['SOTAIKHOAN'] ?></td>
                                <td><?php echo currency_format($row_naptien['SOTIEN']) . " đ"?></td>
                                <td><?php if ($row_naptien['DADUYET'] == 1) {
                                            echo "Thành công";
                                        } else {
                                            echo "Đang xác nhận";
                                        } ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>