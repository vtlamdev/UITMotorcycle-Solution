<?php
include('./includes/connect_database.php');
include('./function/common_function.php');
?>

<head>
    <link rel="stylesheet" href="./CSS/user.css">
</head>

<body>
    <div class="mt-2">
        <h3>Đổi mật khẩu</h3>
        <p>Để bảo mật tài khoản vui lòng không chia sẻ mật khẩu cho người khác</p>
    </div>

    <div class="row password">
        <div class="col-lg-10">
            <form action="" method="post">
                <?php
                $username=$_SESSION['username'];
                $select_taikhoan="select * from `taikhoan` where tendangnhap='$username'";
                $select_taikhoan_run=mysqli_query($con,$select_taikhoan);
                $row_taikhoan=mysqli_fetch_assoc($select_taikhoan_run);
                $get_email=$row_taikhoan['email'];
            ?>
                <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                    <label for="">Gmail</label>
                    <input class="form-control" style="width: 70%;" type="text" name="old_pwd" placeholder=""
                        value="<?php echo $get_email ?>" disabled />
                </div>
                <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                    <label for="">Mật khẩu mới</label>
                    <input class="form-control" style="width: 70%;" type="password" name="new_pwd"
                        placeholder="Nhập mật khẩu mới" value="" />
                </div>
                <div class="form-group d-flex flex-row justify-content-between align-items-center mb-5">
                    <label for="">Nhập lại mật khẩu</label>
                    <input class="form-control" style="width: 70%;" type="password" name="confirm_pwd"
                        placeholder="Nhập lại mật khẩu" value="" />
                </div>

                <?php
    if(isset($_SESSION['status_password']))
    {
?>
                <div class="alert alert-success text-center">
                    <h5><?= $_SESSION['status_password']; ?></h5>
                </div>
                <?php
    unset($_SESSION['status_password']);   
    }
?>
                <button class="btn btn-danger button" type="submit" name="thaydoi">Lưu thay đổi</button>
                <button class="btn btn-sm btn-danger button_sm" type="submit" name="thaydoi">Lưu thay đổi</button>
            </form>

        </div>
</body>
<?php
if(isset($_POST['thaydoi']))
{
    $new_pwd = $_POST['new_pwd'];
    $confirm_pwd = $_POST['confirm_pwd'];
    $getussername=$_SESSION['username'];
    $spacing=" ";
    if($new_pwd=='' or $confirm_pwd =='')
    {
        $_SESSION['status_password']="Vui lòng nhập đầy đủ thông tin";
        echo "<script>window.open('user.php?password','_self')</script>";
        exit(0);
    }
    if(!preg_match("/^[0-9-a-zA-Z\s]+$/", $new_pwd) or strpos($new_pwd, $spacing) or !preg_match("/^[0-9-a-zA-Z\s]+$/", $confirm_pwd) or strpos($confirm_pwd, $spacing))
    {
      $_SESSION['status_password']="Mật khẩu không hợp lệ";
      header("Location:user.php?password");
      exit(0);
    }
    if(strlen($new_pwd)<8)
    {
      $_SESSION['status_password']="Độ dài mật khẩu phải có ít nhất 8 ký tự";
      header("Location:user.php?password");
      exit(0);
    }
    else
    {
        if($new_pwd==$confirm_pwd)
        {
            $hash_pwd =password_hash($new_pwd,PASSWORD_DEFAULT );
            $update_pwd="update `taikhoan` set matkhau='$hash_pwd' where tendangnhap='$getussername'";
            $update_pwd_run=mysqli_query($con,$update_pwd);
            if($update_pwd_run)
            {
                $_SESSION['status_password']="Cập nhập thành công";
                echo "<script>window.open('logout.php','_self')</script>";
                exit(0);
            }
            else
            {
                $_SESSION['status_password']="Đã có lỗi xảy ra";
                echo "<script>window.open('user.php?password','_self')</script>";
                exit(0);
            }
        }
        else
        {
            $_SESSION['status_password']="Mật khẩu không khớp";
            echo "<script>window.open('user.php?password','_self')</script>";
            exit(0);
        }
    }
}
?>