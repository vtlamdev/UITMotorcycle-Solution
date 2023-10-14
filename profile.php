<?php
include('./includes/connect_database.php');
include('./function/common_function.php');
?>

<head>
    <!-- custom css -->
    <link rel="stylesheet" href="./CSS/user.css">

</head>

<div class="mt-2 profile_title">
    <h1>Hồ sơ của tôi</h1>
    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
</div>
<div class="row profile">
    <div class="col-lg-10">
        <form action="" method="post">
            <?php
                $username=$_SESSION['username'];
                $select_makh="select * from `taikhoan` where tendangnhap='$username'";
                $select_makh_run=mysqli_query($con,$select_makh);
                $row_taikhoan=mysqli_fetch_assoc($select_makh_run);
                $get_makh=$row_taikhoan['MAKH'];
                $select_khachhang="select * from `khachhang` where MAKH='$get_makh'";
                $select_khachhang_run=mysqli_query($con,$select_khachhang);
                $row_khachhang=mysqli_fetch_assoc($select_khachhang_run);
                $get_hoten=$row_khachhang['HOTEN'];
                $get_dchi=$row_khachhang['DCHI'];
                $get_sodt=$row_khachhang['SODT'];
                $get_gioitinh=$row_khachhang['GIOITINH'];
                $get_socccd=$row_khachhang['SOCCCD'];
                $get_ngsinh=$row_khachhang['NGSINH'];
            ?>
            <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                <label for="">Tên đăng nhập</label>
                <input class="form-control" style="width: 70%;" type="text" name="tendangnhap"
                    placeholder="Nhập tên đăng nhập" value="<?php echo $_SESSION['username'] ?>" disabled />
            </div>
            <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                <label for="">Tên</label>
                <input class="form-control" style="width: 70%;" type="text" name="hoten" placeholder="Nhập họ tên"
                    value="<?php echo $get_hoten?>" />
            </div>
            <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                <label>Giới tính</label>
                <label class="form-check-label px-4">Nam <input class="form-check-input" type="radio" value="Nam" <?php if ($get_gioitinh == 'Nam')
                    echo 'checked'; ?> name="gioitinh"></label>
                <label class="form-check-label">Nữ <input class="form-check-input" type="radio" value="Nữ" <?php if ($get_gioitinh == 'Nữ')
                    echo 'checked'; ?> name="gioitinh"></label>
                <label class="form-check-label px-4">Khác <input class="form-check-input" type="radio" value="Khác" <?php if ($get_gioitinh == 'Khác')
                    echo 'checked'; ?> name="gioitinh"></label>
            </div>
            <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                <label for="">Địa chỉ</label>
                <input class="form-control" style="width: 70%;" type="text" name="diachi" placeholder="Nhập địa chỉ"
                    value="<?php echo $get_dchi ?>" />
            </div>
            <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                <label for="">Số điện thoại</label>
                <input class="form-control" style="width: 70%;" type="text" name="sodt" placeholder="Nhập số điện thoại"
                    value="<?php echo $get_sodt?>" />
            </div>
            <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                <label for="">CCCD</label>
                <input class="form-control" style="width: 70%;" type="text" name="cccd" placeholder="Nhập CCCD"
                    value="<?php echo $get_socccd?>" />
            </div>
            <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                <label for="">Ngày sinh</label>
                <input class="form-control" style="width: 70%;" type="date" name="ngaysinh" placeholder="mm-dd-yyyy"
                    value="<?php echo $get_ngsinh;?>" min="1950-01-01" max="2030-12-31" />
            </div>

            <?php
    if(isset($_SESSION['status_profile']))
    {
?>
            <div class="alert alert-success text-center">
                <h5><?= $_SESSION['status_profile']; ?></h5>
            </div>
            <?php
    unset($_SESSION['status_profile']);   
    }
?>
            <button class="btn btn-danger button" type="submit" name="thaydoi">Lưu thay đổi</button>
            <button class="btn btn-sm btn-danger button_sm" type="submit" name="thaydoi">Lưu thay đổi</button>
        </form>

    </div>
</div>
<?php
if(isset($_POST['thaydoi']))
{
    $hoten=$_POST['hoten'];
    $diachi=$_POST['diachi'];
    $sodt=$_POST['sodt'];
    $cccd=$_POST['cccd'];
    $gioitinh=$_POST['gioitinh'];
    $getip=getIPAddress();
    $getussername=$_SESSION['username'];
    $select_taikhoan="select * from `taikhoan` where tendangnhap='$getussername'";
    $select_taikhoan_run=mysqli_query($con,$select_taikhoan);
    $get_row=mysqli_fetch_assoc($select_taikhoan_run);
    $get_makh=$get_row['MAKH'];

    $timestamp = strtotime($_POST['ngaysinh']); 
    $date=date('d',$timestamp);
    $month=date('m',$timestamp);
    $year=date('Y',$timestamp);
    $ngaysinh = $year . "-" . $month . "-" . $date;
    

    if($hoten=='' or $diachi =='' or $sodt==''or $cccd=='' or $ngaysinh=='' or $gioitinh=='')
    {
        $_SESSION['status_profile']="Vui lòng nhập đầy đủ thông tin";
        echo "<script>window.open('user.php?profile','_self')</script>";
        exit(0);
    }
    else
    {
        $update_khachhang="update `khachhang` set HOTEN='$hoten', DCHI='$diachi',SODT='$sodt',NGSINH='$ngaysinh',GIOITINH='$gioitinh',SOCCCD='$cccd' where MAKH='$get_makh'";
        $update_khachhang_run=mysqli_query($con,$update_khachhang);
        if($update_khachhang_run)
        {
            $_SESSION['status_profile']="Cập nhật thông tin thành công";
            echo "<script>window.open('user.php?profile','_self')</script>";
            exit(0);
        }
        else
        {
            $_SESSION['status_profile']="Đã có lỗi xảy ra";
            echo "<script>window.open('user.php?profile','_self')</script>";
            exit(0);
        }
    }
}
?>