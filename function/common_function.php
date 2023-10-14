<?php
include('./includes/connect_database.php');
include('./function/get_ipaddress.php');

function cart()
{
  if (isset($_GET['add_to_card'])) {
    if(!isset($_SESSION['username'])) {
      header('location: Login.php');
      exit;
    }
    else
    {
    global $con;
    $masp = $_GET['add_to_card'];
    $username=$_SESSION['username'];
    $select_makh="select * from `taikhoan` where tendangnhap='$username'";
    $select_makh_run=mysqli_query($con,$select_makh);
    $row_makh=mysqli_fetch_assoc($select_makh_run);
    $get_makh=$row_makh['MAKH'];
    $select_query = "select * from `giohang` where MASP='$masp' and MAKH='$get_makh'";
    $soluong = $_GET['soluong'];
    $select_query_run = mysqli_query($con, $select_query);
    $count = mysqli_num_rows($select_query_run);
    if ($count > 0) {
      echo "<script>alert('Sản phẩm đã có sẵn trong giỏ hàng')</script>";
      echo "<script>window.location.href='page_shopping_cart.php'</script>";
    } else {
      $insert_query = "insert into `giohang` (MASP, MAKH,soluong) values ('$masp','$get_makh','$soluong')";
      $result_query = mysqli_query($con, $insert_query);
      if ($result_query) {
        echo "<script>alert('Sản phẩm đã được thêm vào giỏ hàng') </script>";
        echo "<script>window.location.href='page_shopping_cart.php'</script>";
      }
    }
  }
  }
}


function viewmore()
{
  global $con;
  if (isset($_GET['sanpham'])) {
    $sanpham_id = $_GET['sanpham'];
    $select_query = "SELECT * FROM `hangxe`, `sanpham` WHERE hangxe.MAHANG=sanpham.MAHANG AND MASP = '$sanpham_id'";
    $select_result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($select_result);

    $url_image = $row['URL_IMAGE'];
    $url_image_hang = $row['URLIMAGE'];
    $tenhang = $row['TENHANG'];
    $tensp = $row['TENSP'];
    $phankhoi = $row['PHANKHOI'];
    $mau = $row['MAU'];
    $namsx = $row['NAMSX'];
    $gia = $row['GIA'];
    echo "
<div class='col-12 col-sm-5'>   
<img src='./$url_image' alt='$tensp' style='width: 100%; height: 100%; object-fit: contain;'>

</div>
<div class='col-12 col-sm-7 bg-secondary'>
     
<h3>$tensp<h3>
<h4>$gia VNĐ<h4>
<div class='d-flex flex-row justify-content-star border my-2'><img src='./$url_image_hang' alt='$tenhang' style='width: 100px; height:100%; object-fit:contain;'><h4  class='d-flex flex-col align-items-center'> $tenhang</h4></div>


<div class='bg-light p-2'>
<div class='d-flex flex-row justify-content-between'>
 <p>Năm sản xuất:</p>
 <p>$namsx</p>
 </div>
 <div class='d-flex flex-row justify-content-between'>
 <p>Phân khối:</p>
 <p>$phankhoi</p>
 </div>
 <div class='d-flex flex-row justify-content-between'>
 <p>Màu sắc:</p>
 <p>$mau</p>
 </div>
 </div>
 <a href='shopping_cart.php?add_to_card=$sanpham_id' class=' btn btn-danger'>Thêm vào giỏ hàng</a>
</div>
";
  }
}
function show_don_mua($masp_id, $get_sl, $id, $so_hd)
{
  global $con;
  $total = 0;
 
  $select_cart = "select * from `sanpham` where MASP='$masp_id'";
  $select_cart_run = mysqli_query($con, $select_cart);
  $count_row = mysqli_num_rows($select_cart_run);
  if ($count_row > 0) {
    echo "<form action='' method='post'><div class='table-responsive'><table class='table table-striped table_content' style='text-align:center'>
                    <thead class='thead-dark'>
                        <tr role='row' >
                            <th width='40'>Chọn</th>
                            <th width='100'>
                            Số hóa đơn
                           </th>
                            <th width='160'>
                                Ảnh</th>
                            <th width='180'>
                                Tên sản phẩm
                            </th>
                           
                            <th width='100'>
                                Màu</th>
                            <th width='90'>
                                Số lượng</th>
                            <th width='120'>
                                Tổng tiền</th>
                                <th width='120'>
                                Trạng thái</th>
                            <th width='130'>
                                Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>";
    while ($row_cart = mysqli_fetch_array($select_cart_run)) {
      $masp = $row_cart['MASP'];
      $select_product = "select * from `sanpham` where MASP='$masp'";
      $select_product_run = mysqli_query($con, $select_product);
      while ($row_product = mysqli_fetch_array($select_product_run)) {
        $tensp = $row_product['TENSP'];
        $url_image = $row_product['URL_IMAGE'];
        $mau = $row_product['MAU'];
        $gia = $row_product['GIA'];
        $gia = $gia*$get_sl;
        $total += $gia;
?>
<tr>
    <td><input type="checkbox" name="select[]" value="<?php echo $so_hd ?>"></td>
    <td><?php echo $so_hd; ?></td>
    <td>
        <img style="width: 60%; height: 60%; object-fit: contain;" src="./<?php echo $url_image; ?>"
            alt="<?php echo $tensp ?>">
    </td>
    <td><?php echo $tensp; ?></td>
    <td><?php echo $mau; ?></td>

    <td>
        <?php echo $get_sl ?>
    <td><?php echo currency_format($gia); ?> đ</td>

    <td><?php
              if ($id == 0) {
                echo "Đang giao";
              }
              if ($id == -2) {
                echo "Chờ xác nhận";
              }
              if ($id == 1) {
                echo "Đã giao";
              }
              if ($id == -1) {
                echo "Đã hủy";
              }
              ?></td>
    <td>
        <?php
            if ($id == -2) {
            ?>
        <input type="submit" value="Hủy" name="Huy" class="btn btn-sm btn-outline-danger my-3 button_cancel">
        <?php
            }
            ?>
    </td>
</tr>
<?php
      }
    }
    ?>
</tbody>
</table>
</div>
</form>

<?php
  
  }
 
  
}
function don_mua($id)
{
  global $con;
  $get_username=$_SESSION['username'];
  $select_taikhoan="select * from `taikhoan` where tendangnhap='$get_username'";
  $select_taikhoan_run=mysqli_query($con,$select_taikhoan);
  $row=mysqli_fetch_assoc($select_taikhoan_run);
  $get_makh=$row['MAKH'];
  $select_hoadon = "select * from `hoadon` where TRANGTHAI='$id' and MAKH='$get_makh'";
  $select_hoadon_run = mysqli_query($con, $select_hoadon);
  while ($row = mysqli_fetch_assoc($select_hoadon_run)) {
    $get_sohd = $row['SOHD'];
    $select_cthd = "select * from `cthd` where SOHD='$get_sohd'";
    $select_cthd_run = mysqli_query($con, $select_cthd);
    while ($row_cthd = mysqli_fetch_assoc($select_cthd_run)) {
      $get_masp = $row_cthd['MASP'];
      $get_sl = $row_cthd['SL'];
      show_don_mua($get_masp, $get_sl, $id,$get_sohd);
    }
  }
  if(isset($_POST['Huy']))
  {
    if (isset($_POST['select'])) {
      foreach ($_POST['select'] as $sohd) {
        echo "<script>alert('Bạn đã hủy hóa đơn $sohd')</script>";
        $delete_hoadon="delete from `hoadon` where SOHD='$sohd'";
        $delete_cthd="delete from `cthd` where SOHD='$sohd'";
        $delete_cthd_run=mysqli_query($con, $delete_cthd);
        $delete_hoadon_run=mysqli_query($con, $delete_hoadon);
        echo "<script>window.open('user.php?purchar&type=-3','_self')</script>";
      }
    }
}
}
function don_mua_tatca()
{
  global $con;
  $get_username=$_SESSION['username'];
  $select_taikhoan="select * from `taikhoan` where tendangnhap='$get_username'";
  $select_taikhoan_run=mysqli_query($con,$select_taikhoan);
  $row=mysqli_fetch_assoc($select_taikhoan_run);
  $get_makh=$row['MAKH'];
  $select_hoadon = "select * from `hoadon` where MAKH='$get_makh'";
  $select_hoadon_run = mysqli_query($con, $select_hoadon);
  while ($row = mysqli_fetch_assoc($select_hoadon_run)) {
    $get_sohd = $row['SOHD'];
    $get_trangthai = $row['TRANGTHAI'];
    $select_cthd = "select * from `cthd` where SOHD='$get_sohd'";
    $select_cthd_run = mysqli_query($con, $select_cthd);
    while ($row_cthd = mysqli_fetch_assoc($select_cthd_run)) {
      $get_masp = $row_cthd['MASP'];
      $get_sl = $row_cthd['SL'];
      show_don_mua($get_masp, $get_sl, $get_trangthai,$get_sohd);
    }
  }
  if(isset($_POST['Huy']))
  {
    if (isset($_POST['select'])) {
      foreach ($_POST['select'] as $sohd) {
        echo "<script>alert('Bạn đã hủy hóa đơn $sohd')</script>";
        $select_hoadon_ = "select * from `hoadon` where MAKH='$get_makh' and SOHD='$sohd'";
        $select_hoadon_run_ = mysqli_query($con, $select_hoadon_);
        $row_hoadon=mysqli_fetch_assoc($select_hoadon_run_);
        $get_trigia=$row_hoadon['TRIGIA'];
        $select_khachhang="select * from `khachhang` where MAKH='$get_makh'";
        $select_khachhang_run=mysqli_query($con,$select_khachhang);
        $row_khachhang=mysqli_fetch_assoc($select_khachhang_run);
        $get_sodu=$row_khachhang['SODU'];
        $get_sodu=$get_sodu+$get_trigia;
        $update_khachhang="update `khachhang` set SODU='$get_sodu' where MAKH='$get_makh'";
        $update_khachhang_run=mysqli_query($con,$update_khachhang);
        $update_hoadon="update `hoadon` set TRANGTHAI='-1' where SOHD='$sohd'";
        $update_hoadon_run=mysqli_query($con, $update_hoadon);
        echo "<script>window.open('user.php?purchar&type=-3','_self')</script>";
      }
    }
}
}