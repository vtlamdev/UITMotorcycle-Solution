<?php
include './includes/connect_database.php';
include './function/get_ipaddress.php';
session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <title>UIT MotorCycle Sign Up</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="./asset/DB-Picture/logo.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
        <link rel="stylesheet" href="./CSS/signup.css" />
        <!-- fontawwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <header>
            <a href="index.php">UIT MotorCycle</a>
            <span>Đăng ký</span>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-5">
                    <h2>UIT MotorCycle</h2>
                </div>
                <div class="col-lg-5 col-sm-7 signup_form">
                    <h4>Đăng ký</h4>

                    <form method="post">
                        <div class="form-group">
                            <label for="uname">Tên đăng nhập:</label>
                            <input type="text" class="form-control" id="uname" placeholder="Nhập tên đăng nhập"
                                name="username" />
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mật khẩu:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu"
                                name="pwd" />
                        </div>
                        <div class="form-group">
                            <label for="pwd_comfirm">Nhập lại mật khẩu:</label>
                            <input type="password" class="form-control" id="pwd_comfirm" placeholder="Nhập lại mật khẩu"
                                name="pwd_comfirm" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email" />
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Đăng Ký" name="insert_user" class="btn btn-primary signup_btn">
                        </div>
                        <?php
              if(isset($_SESSION['status']))
              {
                ?>
                        <div class="alert alert-success text-center">
                            <h5><?= $_SESSION['status']?></h5>
                        </div>
                        <?php
                unset($_SESSION['status']);
              }
            ?>
                        <?php
            if(isset($_POST['insert_user']))
            {
              $username=$_POST['username'];
              $pwd=$_POST['pwd'];
              $pwd_confirm=$_POST['pwd_comfirm'];
              $hash_pwd =password_hash($pwd,PASSWORD_DEFAULT );      
              $email=mysqli_real_escape_string($con,$_POST['email']) ;
              $spacing=" ";
              $ip = getIPAddress();  
              if($username=='' or  $pwd=='' or $email=='' or $pwd_confirm=='')
              {
               
                $_SESSION['status']="Vui lòng điền đầy đủ thông tin";
                header("Location:signup.php");
                exit(0);
              }
              if(!preg_match("/^[0-9-a-zA-Z\s]+$/", $username) or strpos($username, $spacing))
              {
                $_SESSION['status']="Tên đăng nhập không hợp lệ";
                header("Location:signup.php");
                exit(0);
              }
              if(strlen($username)<7)
              {
                $_SESSION['status']="Tên đăng nhập phải có ít nhất 6 ký tự";
                header("Location:signup.php");
                exit(0);
              }
              if(!preg_match("/^[0-9-a-zA-Z\s]+$/", $pwd) or strpos($pwd, $spacing) or !preg_match("/^[0-9-a-zA-Z\s]+$/", $pwd_confirm) or strpos($pwd_confirm, $spacing))
              {
                $_SESSION['status']="Mật khẩu không hợp lệ";
                header("Location:signup.php");
                exit(0);
              }
              if(strlen($pwd)<8)
              {
                $_SESSION['status']="Độ dài mật khẩu phải có ít nhất 8 ký tự";
                header("Location:signup.php");
                exit(0);
              }
              if($pwd!==$pwd_confirm)
              {
                $_SESSION['status']="Mật khẩu không khớp";
                header("Location:signup.php");
                exit(0);
              }
              else
              {
                $select_email="select * from `taikhoan` where email='$email'";
                $select_email_run=mysqli_query($con,$select_email);
                $num_email=mysqli_num_rows($select_email_run);
                if($num_email>0)
                {
                  $_SESSION['status']="Email đã tồn tại";
                  header("Location:signup.php");
                  exit(0);
                }
                else
                {
                  if($pwd==$pwd_confirm)
                {
                  $select_query="select * from `taikhoan` where tendangnhap='$username'";
                  $select_result=mysqli_query($con, $select_query);
                  $count_row=mysqli_num_rows($select_result);
                 
                  if($count_row>0)
                  {
                   
                    $_SESSION['status']="Tài khoản đã tồn tại";
                    header("Location:signup.php");
                    exit(0);
                  }
                  else
                  {
                    $getip=getIPAddress();
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $get_date = date('Y:m:d H:i:s');
                    $insert_khachhang="INSERT into `khachhang` (HOTEN,DCHI,SODT,NGSINH,NGDK,SODU,khachhang_ip,GIOITINH,SOCCCD) VALUES ('','','','','$get_date','','$getip','','')";
                    $insert_khachhang_run=mysqli_query($con,$insert_khachhang);
  
                    $select_khachhang="SELECT MAX(MAKH) from `khachhang`";
                    $select_khachhang_run=mysqli_query($con,$select_khachhang);
                    $select_khachhang_row=mysqli_fetch_assoc($select_khachhang_run);
                    $row=$select_khachhang_row['MAX(MAKH)'];
                    
                    $insert_query="insert into `taikhoan`(tendangnhap,MAKH,matkhau,email,khachhang_ip) values('$username','$row','$hash_pwd','$email','$ip')";
                    $result_query=mysqli_query($con,$insert_query);
                   //echo var_dump($result_query);
                    
                    if($result_query)
                    {
                      
                      $_SESSION['status']="Tạo tài khoản thành công";
                      header("Location:signin.php");
                      exit(0);
                    }
                  } 
                }
                else
                {
                  $_SESSION['status']="Mật khẩu không khớp";
                  header("Location:signup.php");
                  exit(0);
                }
                }
              }
            }
            ?>
                        <span class="nav_signin">Bạn đã có tài khoản?
                            <a class="signin" href="./signin.PHP">Đăng nhập ngay</a></span>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>