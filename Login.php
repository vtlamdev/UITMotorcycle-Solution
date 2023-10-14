<?php
ob_start();
session_start();
include './includes/connect_database.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title>UIT MotorCycle Đăng nhập</title>
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
    </head>

    <body>
        <div class="background-radial-gradient overflow-hidden" style="height: 100vh">
            <div class="container px-4 py-5 px-md-5  text-center text-lg-start my-5">
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
                                <form action="" method="post">
                                    <!-- username input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="uname">Tên đăng nhập</label>
                                        <input type="text" class="form-control" id="uname" name="username" />
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="pwd">Mật khẩu</label>
                                        <input type="password" id="pwd" class="form-control" name="pwd" />
                                    </div>

                                    <!-- Checkbox -->
                                    <div class="form-check d-flex mb-4">
                                        <input class="form-check-input me-2" type="checkbox" value=""
                                            id="form2Example33" />
                                        <label class="form-check-label" for="form2Example33">
                                            Nhớ tên tài khoản
                                        </label>
                                    </div>

                                    <!-- Forgot password -->
                                    <div class="d-flex justify-content-end">
                                        <a href="./password_reset.php"
                                            style="text-decoration: none; font-style:italic">Quên mật khẩu?</a>
                                    </div>

                                    <!-- Submit button -->
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary btn-block mb-4" name="login_user">
                                            Đăng nhập
                                        </button>
                                    </div>
                                    <?php
              if(isset($_POST['login_user']))
              {
                $username=$_POST['username'];
                $_SESSION['username']=$username; 
                $pwd=$_POST['pwd'];
                if( $username=='' or $pwd=='')
                {
                  
                  $_SESSION['status']="Vui lòng điền đầy đủ thông tin";
                  unset($_SESSION['username']);
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
                      
                  unset($_SESSION['username']);
                    }
                  }
                  else
                  {
                    $_SESSION['status']="Tên đăng nhập hoặc mật khẩu không chính xác";
                  
                  unset($_SESSION['username']);
                  }
                 }
              }
          ?>
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

                                    <!-- Move to Register page -->
                                    <div class="d-flex justify-content-center">
                                        <span>Chưa có tài khoản?
                                            <a style="color: red; font-style: italic;text-decoration: none;"
                                                href="./Register.php">Đăng ký ngay</a></span>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div>
            <?php include ('./footer.php');?>
        </div> -->
    </body>

</html>