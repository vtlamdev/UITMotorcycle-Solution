<?php
include './includes/connect_database.php';
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./asset/DB-Picture/logo.ico" type="image/x-icon">
        <title>Payment</title>
    </head>

    <body>
        <div class="container payment">
            <h1 class="text-center">Nạp tiền qua MOMO</h1>
            <p class="text-center mt-4">Thời gian phản hồi trong vòng ít nhất 24h kể từ thời gian khách hàng nhập thông
                tin nạp tiền bên dưới.</p>
            <div class="row">
                <div class="col-lg-6 text-center">
                    <img style="height:auto; width:50%; object-fit: contain;" src="Asset/Picture/momo.jpg"
                        class="image mt-4 mx-auto">
                </div>
                <div class="col-lg-6 mt-4">
                    <form action="" method="post">
                        <div class="form-group mx-auto w-60">
                            <label for="date" class="mb-2">Nhập ngày</label>
                            <input type="date" name="date" class="form-control"> <br>
                        </div>
                        <div class="form-group mx-auto w-60">
                            <label for="sotien" class="mb-2">Số tiền</label>
                            <input type="text" name="sotien" class="form-control"> <br>
                        </div>
                        <div class="form-group mx-auto w-60">
                            <label for="sotaikhoan" class="mb-2">Số tài khoản</label>
                            <input type="text" name="sotaikhoan" class="form-control"> <br>
                        </div>
                        <div class="d-flex mx-auto">
                            <input type="submit" class="btn btn-outline-success mx-auto" name="NapTien"
                                value='Nạp tiền'>
                        </div>
                    </form>
                </div>
            </div>

            <?php
        if (isset($_POST["NapTien"]) && $_POST["NapTien"] == "Nạp tiền") {
            if (empty($_POST["date"]) || empty($_POST["sotien"]) || empty($_POST["sotaikhoan"])) {
                echo "<div class='alert alert-danger text-center mt-3'>Vui lòng nhập đầy đủ thông tin</div>";
            } else {
                $get_user = $_SESSION['username'];
                $sql = "Select MAKH from taikhoan where tendangnhap = '$get_user'";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                $makh = $row['MAKH'];
                $sotien = $_POST["sotien"];
                $ngaynap = $_POST["date"];
                $sotaikhoan = $_POST["sotaikhoan"];
                $insert = "INSERT INTO NAPTIEN (`MAKH`, `SOTIEN`, `NGAYNAP`, `SOTAIKHOAN`, `DADUYET`) VALUES ('$makh', '$sotien', '$ngaynap', '$sotaikhoan', 0)";
                $result_query = mysqli_query($con, $insert);
                echo "<script>alert('Chúng tôi đã nhận được yêu cầu nạp tiền của bạn! Vui lòng chờ trong vòng 12h để chúng tôi duyệt!') </script>";
            }
        }
        ?>
        </div>
    </body>

</html>