<?php
    
function Search() {
    if(isset($_GET['search_data']))
    {
        include "./includes/connect_database.php";
        $searchvalues = $_GET['search_data'];
        $split_searchvalue = explode(" ", $searchvalues);
        $searchvalues = "CONCAT(TENSP,TENHANG,TENLOAI,PHANKHOI,NAMSX,MAU) LIKE '%";
        $searchvalues .= implode("%' and CONCAT(TENSP,TENHANG,TENLOAI,PHANKHOI,NAMSX,MAU) LIKE '%", $split_searchvalue);
        $searchvalues .= "%'";
        $query = "SELECT distinct TENSP FROM SANPHAM sp, HANGXE hx, LOAIXE lx WHERE sp.MAHANG = hx.MAHANG and lx.LOAIXE = sp.LOAIXE and $searchvalues";
        $ketqua = $con->query($query);
            
        if(mysqli_num_rows($ketqua) > 0)
        {
            while ($row = $ketqua->fetch_assoc())
            {
                $tensp = $row['TENSP'];
                $select_one = "select TENSP, GIA, URL_IMAGE from sanpham where TENSP='$tensp' LIMIT 1";
                $result = mysqli_query($con, $select_one);
                while ($xe = mysqli_fetch_assoc($result)) {
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
        }
        else
        {
            echo '<div style="text-align: center; margin-bottom: 20px; color: #05c5cc;"><em>Không tìm thấy!</em></div>';
        }
    }
}
 
function Search_Filter() {
    if(isset($_GET['Filter'])&&($_GET['Filter'] == "Lọc sản phẩm"))
    {
        include "./includes/connect_database.php";
               
        $query = "SELECT distinct(TENSP) FROM SANPHAM WHERE IS_ACTIVE = 1";
        if (isset($_GET['LoaiXe']) && !empty($_GET['LoaiXe']))
        {
            $loaixe = $_GET['LoaiXe'];
            $query .= " and LOAIXE = $loaixe";
        }
        if (isset($_GET['HangXe']) && !empty($_GET['HangXe']))
        {
            $hangxe = $_GET['HangXe'];
            $query .= " and MAHANG = $hangxe";
        }
        if (isset($_GET['giaban']))
        {
            $giaban = $_GET['giaban'];
            $query .= " and GIA <= $giaban";
        }
        if (isset($_GET['namsx']))
        {
            $namsx = $_GET['namsx'];
            $query .= " and NAMSX <= $namsx";
        }
        if (isset($_GET['phankhoi']))
        {
            $phankhoi = $_GET['phankhoi'];
            $query .= " and left(PHANKHOI, (length(PHANKHOI)-2))  <= $phankhoi";
        }
        if (isset($_GET['MauSac']))
        {
            $mausac = "MAU like '%";
            $mausac .= implode("%' or MAU like '%", $_GET['MauSac']);
            $mausac .= "%'";
            $query .= " and ($mausac)";
        }
        $ketqua = $con->query($query);
            
        if(mysqli_num_rows($ketqua) > 0)
        {
            while ($row = $ketqua->fetch_assoc())
            {
                $tensp = $row['TENSP'];
                $select_one = "select TENSP, GIA, URL_IMAGE from sanpham where TENSP='$tensp' LIMIT 1";
                $result = mysqli_query($con, $select_one);
                while ($xe = mysqli_fetch_assoc($result)) {
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
        }
        else
        {
            echo '<div style="text-align: center; margin-bottom: 20px; color: #05c5cc;"><em>Không tìm thấy!</em></div>';
        }
    }
}
?>
