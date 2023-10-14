<?php
include('./includes/connect_database.php');
include('./function/common_function.php');
?>
<!DOCTYPE html>
<html>

    <head>
        <title>UIT MotorCycle</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="./asset/DB-Picture/logo.ico" type="image/x-icon">
        <!-- bootstrap cdn -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <!-- fontawwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./CSS/style_main.css">
        <link rel="stylesheet" href="./CSS/style_pagination.css">
    </head>

    <body style="background: #efefef">


        <!-- Header -->
        <?php
    include('./header.php');
    cart();
    ?>

        <div class="container ">
            <div class="row bg-light submenu">
                <div id="0" class="col-3 btn btn-light" onclick="window.location.href='index.php';">
                    <a href="index.php" class="text-decoration-none text-dark">
                        <img src="asset/Picture/icon-grid.svg" height="25px" />
                        <p style="margin-top: 10px">Tất cả</p>
                    </a>
                </div>
                <div id="1" class="col-3 btn btn-light" onclick="window.location.href='index.php?loaixe=1';">
                    <a href="index.php?loaixe=1" class="text-decoration-none text-dark">
                        <img src="asset/Picture/icon-gear.svg" height="25px" />
                        <p style="margin-top: 10px">Xe số</p>
                    </a>
                </div>
                <div id="2" class="col-3 btn btn-light" onclick="window.location.href='index.php?loaixe=2';">
                    <a href="index.php?loaixe=2" class="text-decoration-none text-dark">
                        <img src="asset/Picture/icon-scooter.svg" height="25px" />
                        <p style="margin-top: 10px">Xe tay ga</p>
                    </a>
                </div>
                <div id="3" class="col-3 btn btn-light" onclick="window.location.href='index.php?loaixe=3';">
                    <a href="index.php?loaixe=3" class="text-decoration-none text-dark">
                        <img src="asset/Picture/icon-pkl.svg" height="25px" />
                        <p style="margin-top: 10px">Xe phân khối lớn</p>
                    </a>
                </div>
            </div>

        </div>
        <!-- body -->
        <div class="container border bg-light">

            <!-- slide show -->
            <div class="slider-container__1 ">
                <div id="carouselExampleDark" class="carousel carousel-dark slide " data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="5000">
                            <img src="./Asset/Picture/banner_1.png" class="d-block w-100" alt="">
                        </div>

                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="./Asset/Picture/banner_4.png" class="d-block w-100" alt="">
                        </div>

                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="./Asset/Picture/banner_3.png" class="d-block w-100" alt="">
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- sản phẩm -->
            <div class="row " id="card-row">
                <?php
            include "./includes/connect_database.php";
            include "./function/currency_format.php";
            include "ShowListProducts.php";
            include "search.php";
            LaySanPham();
            Search();
            Search_Filter();
            ?>
            </div>
        </div>
        <div class="container">
            <!-- footer -->
            <?php
        include('./footer.php');
        ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
        </script>
    </body>

</html>