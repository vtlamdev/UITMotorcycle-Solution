<?php
include('../includes/connect_database.php');
include "header.php";
if(isset($_POST['insert_product']))
{
    $valid = 1;
    $select_query="select * from `sanpham`";
    $result_query=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_query);
    $product_id=$number+1;
    
    // $product_name=$_POST['product_name'];
    // $product_meter=$_POST['product_meter'];
    // $product_color1=$_POST['product_color1'];
    // $product_color2=$_POST['product_color2'];
    // $product_color3=$_POST['product_color3'];
    // $product_year=$_POST['product_year'];
    // $product_price=$_POST['product_price'];
    $product_name=$_POST['product_name'];
    $product_color=$_POST['product_color'];
    $product_year=$_POST['product_year'];
    $product_meter=$_POST['product_meter'];
    $product_price=$_POST['product_price'];

    $product_brand_id=$_POST['product_brand'];
    $product_type=$_POST['product_type'];
    $product_is_active = $_POST['p_is_active'];



    // insert image
    $product_image=$_FILES['product_image']['name'];
    $path = $_FILES['product_image']['name'];

    //link image
    $temp_image=$_FILES['product_image']['tmp_name'];

    if($product_name=='' or  $product_meter=='' or $product_color=='' or $product_year=='' or  $product_price=='' or  $product_image=='' or $product_brand_id=='' or $product_type=='' or $product_is_active=='')
    {
        $valid = 0;
        $error_message = 'Vui lòng nhập đầy đủ.';
    }
    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message = 'Bạn phải tải lên file jpg, png, jpeg hoặc gif.';
        }
    }
    if ($valid == 1)
    {
        $product_urlimg="Asset/DB-Picture/".$product_image;
        move_uploaded_file( $temp_image,'../'.$product_urlimg);

        //insert
        $insert_product="insert into `sanpham`(MASP,TENSP,MAU,NAMSX,PHANKHOI,MAHANG,LOAIXE,GIA,URL_IMAGE, IS_ACTIVE)
        values('".$product_id."','".$product_name."','".$product_color."','".$product_year."', '".$product_meter."', '".$product_brand_id."','".$product_type."', '".$product_price."','".$product_urlimg."','".$product_is_active."')";
        $result_query=mysqli_query($con, $insert_product);
        if($result_query)
        {
            $success_message = 'Thêm sản phẩm thành công.';
        }
        else
        {
            $error_message = 'Không thể thêm sản phẩm.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Insert cart</title>
    </head>

    <body>
        <div class="container mt-3">
            <h1 class="text-center">Thêm sản phẩm</h1>
            <?php if(isset($error_message)): ?>
            <div class="alert alert-danger">

                <label><?php echo $error_message; ?></label>
            </div>
            <?php endif; ?>

            <?php if(isset($success_message)): ?>
            <div class="alert alert-success">

                <label><?php echo $success_message; ?></label>
            </div>
            <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_name" class="form-label">Tên sản phẩm</label>
                    <input type="text" name="product_name" class="form-control" placeholder="Nhập tên sản phẩm"
                        autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_color" class="form-label">Màu</label>
                    <input type="text" name="product_color" class="form-control" placeholder="Nhập màu sản phẩm"
                        autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_year" class="form-label">Năm sản xuất</label>
                    <input type="text" name="product_year" class="form-control" placeholder="Nhập năm sản xuất"
                        autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_meter" class="form-label">Phân khối</label>
                    <input type="text" name="product_meter" class="form-control" placeholder="Nhập phân khối xe"
                        autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_meter" class="form-label">Số lượng</label>
                    <input type="text" name="product_meter" class="form-control" placeholder="Nhập số lượng sản phẩm"
                        autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <label for="product_price" class="form-label">Giá sản phẩm</label>
                    <input type="text" name="product_price" class="form-control" placeholder="Nhập giá sản phẩm"
                        autocomplete="off" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <select name="product_type" id="" class="form-select">
                        <option value="">Loại xe</option>
                        <?php
                            $select_type="select * FROM `loaixe`";
                            $type_query=mysqli_query($con, $select_type);
                            while($row=mysqli_fetch_assoc($type_query))
                            {
                                $type_name=$row['TENLOAI'];
                                $type_id=$row['LOAIXE'];

                                echo"<option value='$type_id'>$type_name</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <select name="product_brand" id="" class="form-select">
                        <option value="">Hãng xe</option>
                        <?php
                            $select_brand="select * from `hangxe`";
                            $brand_query=mysqli_query($con, $select_brand);
                            while($row=mysqli_fetch_assoc($brand_query))
                            {
                                $brand_name=$row['TENHANG'];
                                $brand_id=$row['MAHANG'];

                                echo"<option value='$brand_id'>$brand_name</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <input type="file" name="product_image" id="product_image" class="form-control" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <select name="p_is_active" class="form-select">
                        <option value="">Hiển thị?</option>
                        <option value="0">Không</option>
                        <option value="1">Có</option>
                    </select>
                </div>
                <div class="form-outline mb-4 w-50 m-auto">
                    <input type="submit" name="insert_product" value="Thêm sản phẩm" class="btn btn-info mb-3 px-3"
                        required="required">
                </div>
            </form>
        </div>
    </body>

</html>