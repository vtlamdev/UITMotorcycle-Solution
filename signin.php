<?php
session_start();
include './includes/connect_database.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title>UIT MotorCycle Sign In</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="./asset/DB-Picture/logo.ico" type="image/x-icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
            rel="stylesheet" />
        <link rel="stylesheet" href="./CSS/signin.css" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <header>
            <a href="index.php">UIT MotorCycle</a>
            <span>Đăng nhập</span>
        </header>
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-5">
                    <h2>UIT MotorCycle</h2>
                </div>
                <div class="col-lg-5 col-sm-7 signin_form">
                    <h4>Đăng nhập</h4>

                    <form action="" method="post">
                        <div class="form-group">
                            <label for="uname">Tên đăng nhập:</label>
                            <input type="text" class="form-control" id="uname" placeholder="Nhập tên đăng nhập"
                                name="username" />
                        </div>
                        <div class="form-group">
                            <label for="pwd">Mật khẩu:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Nhập mật khẩu"
                                name="pwd" />
                            <div class="forget_pwd">
                                <a href="./password_reset.php">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <input type="submit" name="login_user" value="Đăng nhập" class="btn btn-primary signin_btn">
                        <?php
                    
          if(isset($_SESSION['status']))
          {
            //$x=var_dump($_SESSION['status']);
           // echo $x;
            ?>
                        <div class="alert alert-success text-center">
                            <h5><?= $_SESSION['status']; ?></h5>
                        </div>
                        <?php
            unset($_SESSION['status']);
          }
          ?>
                        <span class="nav_signup">Chưa có tài khoản?
                            <a class="signup" href="./signup.php">Đăng ký ngay</a></span>
                    </form>
                    <?php
              if(isset($_POST['login_user']))
              {
                $username=$_POST['username'];
                $_SESSION['username']=$username; 
                $pwd=$_POST['pwd'];
                if( $username=='' or $pwd=='')
                {
                  
                  $_SESSION['status']="Vui lòng điền đẩy đủ thông tin";
                  header("Location:signin.php");
                  exit(0);
                }
                else
                {
                  $check_query="select * from `taikhoan` where tendangnhap='$username'";
                  $result_query=mysqli_query($con, $check_query);
                  $count_row=mysqli_num_rows( $result_query);  
                  $row_data=mysqli_fetch_assoc( $result_query);
                 
                  if($count_row==1)
                  {
                    if(password_verify( $pwd,$row_data['matkhau']))
                    {
                     
                      $_SESSION['status']="Đăng nhập thành công";
                      $_SESSION['username']=$username; 
                      header("Location:index.php");
                      exit(0);
                    }
                    else
                    {
                      $_SESSION['status']="Tên đăng nhập hoặc mật khẩu không chính xác";
                      header("Location:signin.php");
                      exit(0);
                    }
                  }
                  else
                  {
                    $_SESSION['status']="Tên đăng nhập hoặc mật khẩu không chính xác";
                    header("Location:signin.php");
                    exit(0);
                  }
                 }
              }
          ?>
                </div>
            </div>
        </div>
    </body>

</html>