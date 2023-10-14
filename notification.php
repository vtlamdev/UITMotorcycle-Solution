<div class="container border mx-auto">
    <div class="row">
        <?php
        $get_tdn = $_SESSION['username'];
        $select_makh = "select * from `taikhoan` where tendangnhap='$get_tdn'";
        $select_makh_run = mysqli_query($con, $select_makh);
        $row = mysqli_fetch_assoc($select_makh_run);
        $makh = $row['MAKH'];
        $select_hoadon = "select * from `hoadon` where MAKH='$makh'";
        $select_hoadon_run = mysqli_query($con, $select_hoadon);
        while ($row_hoadon = mysqli_fetch_assoc($select_hoadon_run)) {
            $get_trangthai = $row_hoadon['TRANGTHAI'];
            $get_sohd = $row_hoadon['SOHD'];
            $select_cthd = "select * from `cthd` where SOHD='$get_sohd'";
            $select_cthd_run = mysqli_query($con, $select_cthd);
            $row_cthd = mysqli_fetch_assoc($select_cthd_run);
            $get_masp = $row_cthd['MASP'];
            $select_sanpham = "select * from `sanpham` where MASP='$get_masp'";
            $select_sanpham_run = mysqli_query($con, $select_sanpham);
            $row_sanpham = mysqli_fetch_assoc($select_sanpham_run);
            $get_image = $row_sanpham['URL_IMAGE'];
            $get_ten=$row_sanpham['TENSP'];
        ?>

        <div class="col-md-12 my-3 shadow-lg rounded ">
            <div class="d-flex flex-row notification my-3">
                <img class="align-self-start my-auto"
                    style="width: 25%; height: 30%; object-fit: contain;padding-right: 10px"
                    src="./<?php echo $get_image ?>" alt="<?php echo "" ?>">
                <div class="d-flex flex-column align-self-center notification_content">
                    <h5 class="py-2">
                        <?php
                            if ($get_trangthai == -2) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đang chờ để được xác nhận.";
                            }
                            if ($get_trangthai == 0) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đang được giao";
                            }
                            if ($get_trangthai == 1) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đã giao thành công";
                            }
                            if ($get_trangthai == -1) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đã được hủy";
                            }
                            ?>
                    </h5>
                    <p>
                        <?php
                            if ($get_trangthai == -2) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đang chờ để được xác nhận vui lòng đợi trong vòng 24h để chúng tôi làm việc";
                            }
                            if ($get_trangthai == 0) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đang được giao dự kiến sẽ đến trong vòng 2-3 ngày";
                            }
                            if ($get_trangthai == 1) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đã giao thành công cảm ơn quý khách đã tin tưởng";
                            }
                            if ($get_trangthai == -1) {
                                echo "Đơn hàng có số hóa đơn " . $get_sohd . " đã được hủy";
                            }
                            ?>
                    </p>
                    <p>
                        <?php
                            echo "Ngày hóa đơn: " . $row_hoadon['NGHD'];
                            ?>
                    </p>
                </div>

            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>