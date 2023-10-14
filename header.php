<?php
ob_start();
session_start();
include('./includes/connect_database.php');
?>
<link rel="stylesheet" href="./CSS/style_header.css">
<nav class="container navbar navbar-expand-lg bg-info set_Color_nav">
    <div class="container-fluid ">
        <a class="navbar-brand" href="index.php"><img src="./Asset/Picture/logo.jpg" alt="" width="70" height="70"
                class="d-inline-block align-top logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" id="nav_ul">

                <!-- tượng trưng -->

                <?php
                if(isset($_SESSION['username']))
                {
                    $username=$_SESSION['username'];
                    $select_makh="select * from `taikhoan` where tendangnhap='$username'";
                    $select_makh_run=mysqli_query($con,$select_makh);
                    $row_makh=mysqli_fetch_assoc($select_makh_run);
                    $get_makh=$row_makh['MAKH'];
                    $select_cart = "select * from `giohang` where MAKH='$get_makh'";
                    $select_cart_run = mysqli_query($con, $select_cart);
                    $count_row = mysqli_num_rows($select_cart_run);
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="./user.php?profile"><i class="fa-solid fa-user"></i>
                        <?php echo $_SESSION['username'] ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="page_shopping_cart.php"><i
                            class="fa-solid fa-cart-shopping"></i><sup><?php echo $count_row ?></sup> Giỏ hàng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./logout.php"><i class="fas fa-sign-out"></i> Đăng xuất</a>
                </li>
                <?php
                }
                else
                {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="./Login.php"><i class="fas fa-sign-out"></i> Đăng nhập</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./Register.php"><i class="fas fa-sign-in"></i> Đăng ký</a>
                </li>

                <?php
                }
                ?>
            </ul>
            <form class="d-flex" role="search" action="index.php" method="GET">
                <input class="form-control me-2" name="search_data" type="search" placeholder="Tìm kiếm xe"
                    aria-label="Search">
                <input type="submit" value="Tìm kiếm" class="btn btn-outline-light" name="search_data_product">
            </form>
            <form id="nav_btnBoloc" class="d-flex">
                <input id="myBtn" type="button" value="Bộ lọc" class="btn btn-outline-light">
            </form>

            <?php
                include "./search_popup.php";
            ?>
        </div>
    </div>
</nav>