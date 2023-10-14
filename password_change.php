<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./asset/DB-Picture/logo.ico" type="image/x-icon">
        <link rel="stylesheet" href="CSS/style_header.css">
        <!-- bootstrap cdn -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- fontawwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- css -->
        <link rel="stylesheet" href="./CSS/pwd_reset.css">
    </head>

    <body>
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="password-reset-code.php" method="post" class="pwd_change_form">
                        <input type="hidden" name="password_token"
                            value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>" />
                        <div class="form-group w-80">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control"
                                value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>"
                                placeholder="Nhập email" />
                        </div>
                        <div class="form-group w-80">
                            <label for="">Mật khẩu mới</label>
                            <input type="text" name="new_password" class="form-control"
                                placeholder="Nhập mật khẩu mới" />
                        </div>
                        <div class="form-group w-80">
                            <label for="">Nhập lại mật khẩu</label>
                            <input type="text" name="confirm_password" class="form-control"
                                placeholder="Nhập lại mật khẩu" />
                        </div>
                        <?php
            
            if(isset($_SESSION['status']))
            {
              ?>
                        <div class="alert alert-success mt-3">
                            <h5><?= $_SESSION['status']?></h5>
                        </div>
                        <?php
              unset($_SESSION['status']);
            }
            ?>
                        <button name="password_update" type="submit" class="btn btn-md btn-success">ĐẶT LẠI</button>

                    </form>
                </div>
            </div>
        </div>
    </body>

</html>