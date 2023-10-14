<?php
ob_start();
include './includes/connect_database.php';
include './function/get_ipaddress.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>UIT MotorCycle Đăng ký</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="./asset/DB-Picture/logo.ico" type="image/x-icon" />
        <!-- bootstrap cdn -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
            crossorigin="anonymous" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <section class="background-radial-gradient overflow-hidden">
            <style>
            .background-radial-gradient {
                background-color: hsl(218, 41%, 15%);
                background-image: radial-gradient(650px circle at 0% 0%,
                        hsl(218, 41%, 35%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                        hsl(218, 41%, 45%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%);
            }

            #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }
            </style>

            <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
                <div class="row gx-lg-5 align-items-center mb-5">
                    <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                            Cửa hàng bán xe máy <br /><a href="index.php"
                                style="text-decoration: none;color: hsl(218, 81%, 75%)">UIT MotorCycle</a>
                        </h1>
                        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                            Trang web thương mại điện tử cung cấp các mẫu xe máy trên toàn quốc.
                        </p>
                    </div>

                    <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                        <div class="card bg-glass">
                            <div class="card-body px-4 py-5 px-md-5">
                                <form method="post">
                                    <!-- username input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="uname">Tên đăng nhập</label>
                                        <input type="text" class="form-control" id="uname" name="username" />
                                    </div>

                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" class="form-control" name="email" />
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="pwd">Mật khẩu</label>
                                        <input type="password" id="pwd" class="form-control" name="pwd" />
                                    </div>

                                    <!--Confirm password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="pwd_comfirm">Nhập lại mật
                                            khẩu</label>
                                        <input type="password" id="pwd_comfirm" class="form-control"
                                            name="pwd_comfirm" />
                                    </div>

                                    <!-- Submit button -->
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block mb-4" name="insert_user">
                                            Đăng ký
                                        </button>
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
                header("Location:Register.php");
                exit(0);
              }
              if(!preg_match("/^[0-9-a-zA-Z\s]+$/", $username) or strpos($username, $spacing))
              {
                $_SESSION['status']="Tên đăng nhập không hợp lệ";
                header("Location:Register.php");
                exit(0);
              }
              if(strlen($username)<7)
              {
                $_SESSION['status']="Tên đăng nhập phải có ít nhất 6 ký tự";
                header("Location:Register.php");
                exit(0);
              }
              if(!preg_match("/^[0-9-a-zA-Z\s]+$/", $pwd) or strpos($pwd, $spacing) or !preg_match("/^[0-9-a-zA-Z\s]+$/", $pwd_confirm) or strpos($pwd_confirm, $spacing))
              {
                $_SESSION['status']="Mật khẩu không hợp lệ";
                header("Location:Register.php");
                exit(0);
              }
              if(strlen($pwd)<8)
              {
                $_SESSION['status']="Độ dài mật khẩu phải có ít nhất 8 ký tự";
                header("Location:Register.php");
                exit(0);
              }
              if($pwd!==$pwd_confirm)
              {
                $_SESSION['status']="Mật khẩu không khớp";
                header("Location:Register.php");
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
                  header("Location:Register.php");
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
                    header("Location:Register.php");
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
                      header("Location:Login.php");
                      exit(0);
                    }
                  } 
                }
                else
                {
                  $_SESSION['status']="Mật khẩu không khớp";
                  header("Location:Register.php");
                  exit(0);
                }
                }
              }
            }
            ?>
                                    <!-- Move to Register page -->
                                    <div class="d-flex justify-content-center">
                                        <span>Bạn đã có tài khoản?
                                            <a style="color: red; font-style: italic;text-decoration: none;"
                                                href="./Login.php">Đăng nhập ngay</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>

</html>