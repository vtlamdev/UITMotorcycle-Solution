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
                                    <th width="50" scope="col">
                                        Số hóa đơn</th>
                                    <th width="50" scope="col">
                                        Mã khách hàng</th>
                                    <th width="160" scope="col">
                                        Tên khách hàng</th>
                                    <th width="250" scope="col">
                                        Tên sản phẩm và số lượng</th>
                                    <th width="160" scope="col">
                                        Ngày hóa đơn</th>
                                    <th width="160" scope="col">
                                        Tổng tiền</th>
                                    <th width="120" scope="col">
                                        Trạng thái</th>
                                    <th width="160" scope="col">
                                        Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $select_query = "SELECT * FROM HOADON, KHACHHANG WHERE HOADON.MAKH = KHACHHANG.MAKH ORDER BY SOHD DESC";
                            $result_query = mysqli_query($con, $select_query);
                            while ($row = mysqli_fetch_assoc($result_query)) {
                                $sohd = $row['SOHD'];
                                $makh = $row['MAKH'];
                                $tenkh = $row['HOTEN'];
                                $tongtien = $row['TRIGIA'];
                                $ngayhd = $row['NGHD'];
                                $trangthai = $row['TRANGTHAI'];
                                switch ($trangthai) {
                                    case -2:
                                        $trangthai_text = "Chờ xác nhận";
                                        break;
                                    case -1:
                                        $trangthai_text = "Đã hủy";
                                        break;
                                    case 0:
                                        $trangthai_text = "Đang giao";
                                        break;
                                    case 1:
                                        $trangthai_text = "Đã giao";
                                        break;
                                }
                                $select_query1 = "SELECT * FROM CTHD, SANPHAM WHERE CTHD.MASP = SANPHAM.MASP AND SOHD = $sohd";
                                $result_query1 = mysqli_query($con, $select_query1);
                                echo "<tr style='text-align:center'>";
                                echo "<td style='text-align:left'>";
                                echo $sohd;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $makh;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $tenkh;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                while ($row1 = mysqli_fetch_assoc($result_query1)) {
                                    $tensp = $row1['TENSP'];
                                    $soluong = $row1['SL'];
                                    echo $tensp . ": " . $soluong . "<br>";
                                }
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $ngayhd;
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo currency_format($tongtien) . " đ";
                                echo "</td>";
                                echo "<td style='text-align:left'>";
                                echo $trangthai_text;
                                echo "</td>";
                            ?>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-whatever="<?php echo $sohd ?>"
                                        order_status="<?php echo $trangthai ?>">Sửa trạng
                                        thái</button>
                                </td>

                                <?php
                            }
                            ?>
                            </tbody>
                            <!-- modal -->

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post">
                                                <div class="mb-3">
                                                    <label for="recipient-name" class="col-form-label">Hóa đơn: </label>
                                                    <input type="hidden" name="sohd_" value="" class="form-control"
                                                        id="recipient-name">
                                                    <input type="text" name="sohd_" value="" class="form-control"
                                                        id="recipient-name_" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="message-text" class="col-form-label">Trạng thái:</label>
                                                    <!-- <textarea class="form-control" id="message-text"></textarea> -->
                                                    <select name="trang_thai" id="trang_thai">
                                                        <option value="">Chọn trạng thái</option>
                                                        <option value="0">Đang giao</option>
                                                        <option value="1">Đã giao</option>
                                                        <option value="-1">Đã hủy</option>
                                                    </select>
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" name="cap_nhat" class="btn btn-primary">Cập
                                                nhật</button>
                                        </div>
                                        </form>
                                        <?php
                                    if (isset($_POST['cap_nhat'])) {
                                        $get_sohd = $_POST['sohd_'];
                                        $get_trangthai = $_POST['trang_thai'];
                                        $select_hoadon="select * from `hoadon` where SOHD='$get_sohd'";
                                        $select_hoadon_run=mysqli_query($con,$select_hoadon);
                                        $row_hoadon=mysqli_fetch_assoc($select_hoadon_run);
                                        $get_tt=$row_hoadon['TRANGTHAI'];
                                        if($get_trangthai==$get_tt)
                                        {
                                            echo "<script>alert('Đã có lỗi xảy ra vui lòng chọn lại')</script>";
                                            echo "<script>window.open('all_order.php','_self')</script>";
                                            exit();
                                        }
                                        $update_hd = "update `hoadon` set TRANGTHAI='$get_trangthai' where SOHD='$get_sohd'";
                                        $update_hd_run = mysqli_query($con, $update_hd);
                                        if($get_trangthai==-1)
                                        {
                                            $makh = $row_hoadon['MAKH'];
                                            $trigia = $row_hoadon['TRIGIA'];
                                            $update_kh="update KHACHHANG set SODU = SODU + $trigia where MAKH='$makh'";
                                            $update_kh_run=mysqli_query($con,$update_kh);
                                        }
                                        if($get_trangthai==0)
                                        {
                                            $select_cthd="select * from `cthd` where SOHD='$get_sohd'";
                                            $select_cthd_run=mysqli_query($con,$select_cthd);
                                            while($row_cthd=mysqli_fetch_assoc($select_cthd_run))
                                            {
                                                $get_masp=$row_cthd['MASP'];
                                                $select_sp="select * from `sanpham` where MASP='$get_masp'";
                                                $select_sp_run=mysqli_query($con,$select_sp);
                                                $row_sp=mysqli_fetch_assoc($select_sp_run);
                                                $get_sl=$row_sp['SOLUONG'];
                                                $get_sl=$get_sl-1;
                                                $update_sp="update `sanpham` set SOLUONG='$get_sl' where MASP='$get_masp'";
                                                $update_sp_run=mysqli_query($con,$update_sp);
                                            }
                                        }
                                        if ($update_hd_run) {
                                            //echo var_dump($get_trangthai);
                                            echo "<script>alert('Thành công')</script>";
                                            echo "<script>window.open('all_order.php','_self')</script>";
                                        }
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>

                            <!--  -->
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </body>

</html>
<script>
const exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', event => {
    // Button that triggered the modal
    const button = event.relatedTarget
    // Extract info from data-bs-* attributes
    const recipient = button.getAttribute('data-bs-whatever')
    const status = button.getAttribute("order_status")
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    const modalTitle = exampleModal.querySelector('.modal-title')
    // const modalBodyInput = exampleModal.querySelector('.modal-body input')
    const modalBodyInput = document.getElementById('recipient-name');
    const modalBodyInput_ = document.getElementById('recipient-name_');
    const modalStatus = document.getElementById('trang_thai');
    if (status == 1 || status == -1) {
        modalStatus.disabled = true;
    } else {
        modalStatus.disabled = false;
    }

    modalTitle.textContent = `Cập nhật trạng thái hóa đơn: ${recipient}`
    modalBodyInput.value = recipient
    modalBodyInput_.value = recipient
    if (status != -2) {
        modalStatus.value = status;
    }
})
</script>