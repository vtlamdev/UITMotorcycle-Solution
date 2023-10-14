<?php
    include "./includes/connect_database.php";
    function LaySanPham()
    {
        global $con;
        if (!isset($_GET['search_data']) && (!isset($_GET['Filter'])||($_GET['Filter'] != "Lọc sản phẩm")))
        {
            if (isset($_GET['trang']) && $_GET['trang']!="" && $_GET['trang']>=1) {
                $trang = $_GET['trang'];
            } else {
                $trang = 1;
            }
        
            $sp_tren_trang = 12;
            $offset = ($trang-1) * $sp_tren_trang;
            $previous_page = $trang - 1;
            $next_page = $trang + 1;
            $adjacents = "2";
            if (!isset($_GET['loaixe']))
            {
                $result_count = mysqli_query($con,"SELECT COUNT(distinct TENSP) As tong_so_xe FROM `sanpham`");
            }
            else if (isset($_GET['loaixe']))
            {
                $loaixe = $_GET['loaixe'];
                $result_count = mysqli_query($con,"SELECT COUNT(distinct TENSP) As tong_so_xe FROM `sanpham` where LOAIXE = $loaixe");
            }
            $tong_so_xe = mysqli_fetch_array($result_count);
            $tong_so_xe = $tong_so_xe['tong_so_xe'];
            $tong_so_trang = ceil($tong_so_xe / $sp_tren_trang);
            $second_last = $tong_so_trang - 1;
            if (!isset($_GET['loaixe']))
            {
                $result = mysqli_query($con,"SELECT distinct TENSP FROM `sanpham` LIMIT $offset, $sp_tren_trang");
                $url = "index.php?";
            }
            else if (isset($_GET['loaixe']))
            {
                $loaixe = $_GET['loaixe'];
                $result = mysqli_query($con,"SELECT distinct TENSP FROM `sanpham` where LOAIXE = $loaixe LIMIT $offset, $sp_tren_trang");
                $url = "index.php?loaixe=$loaixe";
            }
            while($row = mysqli_fetch_array($result)){
                $tensp = $row['TENSP'];
                $select_one = "select TENSP, GIA, URL_IMAGE from sanpham where TENSP='$tensp' LIMIT 1";
                $kq = mysqli_query($con, $select_one);
                while ($xe = mysqli_fetch_assoc($kq)) {
                    echo '
                        <div class="col-6 col-md-4  mb-2 ">
                            <div class="card">
                                <img src="' . $xe['URL_IMAGE'] . '" class="card-img-top" alt="$product_image3">
                                <div class="card-body">
                                    <h5 class="card-title">' . $xe['TENSP'] . '</h5>
                                    <p class="card-text">' . currency_format($xe['GIA']) . ' đ</p>
                                    <a href="Product_Detail.php?tenxe=' . $xe['TENSP'] . '" class="btn btn-secondary" id="btnViewMore">View more</a>
                                </div>
                            </div>
                        </div>
                    ';
                }
            }
            mysqli_close($con);
            include "pagination.php";
        }
    }
?>