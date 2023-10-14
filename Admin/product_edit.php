<?php
include('../includes/connect_database.php');
include "header.php";
if(isset($_POST['update_btn']) &&$_POST['update_btn']=="Cập nhật") {
	$valid = 1;

    $path = $_FILES['new_image']['name'];
    $path_tmp = $_FILES['new_image']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message = 'Bạn phải tải lên file jpg, png, jpeg hoặc gif.';
        }
    }

    if($valid == 1)
    {
        if($path == '') {
            $statement=$con->prepare("UPDATE `sanpham` SET
            TENSP=?,
            MAU=?,
            NAMSX=?,
            PHANKHOI=?,
            SOLUONG=?,
            GIA=?,
            MAHANG=?,
            LOAIXE=?,
            URL_IMAGE=?,
            IS_ACTIVE=?
            
            WHERE MASP=?");
            
            $statement->execute(array(
            $_POST['product_name'],
            $_POST['product_color'],
            $_POST['product_year'],
            $_POST['product_meter'],
            $_POST['product_qty'],
            $_POST['product_price'],
            $_POST['product_brand'],
            $_POST['product_type'],
            $_POST['current_photo'],
            $_POST['p_is_active'],
            $_REQUEST['id']
            ));
            }
        else {
            $final_name = 'Asset/DB-Picture/'.$path;
            move_uploaded_file( $path_tmp, '../'.$final_name );
            
            
            $statement=$con->prepare("UPDATE `sanpham` SET
            TENSP=?,
            MAU=?,
            NAMSX=?,
            PHANKHOI=?,
            SOLUONG=?,
            GIA=?,
            MAHANG=?,
            LOAIXE=?,
            URL_IMAGE=?,
            IS_ACTIVE=?
            
            WHERE MASP=?");
            
            $statement->execute(array(
            $_POST['product_name'],
            $_POST['product_color'],
            $_POST['product_year'],
            $_POST['product_meter'],
            $_POST['product_qty'],
            $_POST['product_price'],
            $_POST['product_brand'],
            $_POST['product_type'],
            $final_name,
            $_POST['p_is_active'],
            $_REQUEST['id']));
        }
        $success_message = 'Sản phẩm đã được cập nhật thành công.';
    }
}

?>

<?php
if(!isset($_REQUEST['id'])) {
    ('location: view_products.php');
	exit;
} else {
	// Check the id is valid or not
    $id=$_REQUEST['id'];
    $select_query="select * FROM `sanpham` WHERE MASP='".$id."'";
    $result_query=mysqli_query($con, $select_query);
    $number=mysqli_num_rows($result_query);
    if($number==0)
    {
        ('location: view_products.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product edit</title>
    </head>

    <body>
        <div class="container mt-3 m-auto">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <h1>Edit product</h1>
                    </div>
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <a href="view_products.php" class="btn btn-primary btn-sm">View All</a>
                    </div>
                </div>
            </div>

            <?php

$id=$_REQUEST['id'];
$select_query="select * from `sanpham` WHERE MASP='".$id."'";
    $result_query=mysqli_query($con, $select_query);
while($row=mysqli_fetch_assoc($result_query))
    {
        $product_name=$row['TENSP'];
        $product_color=$row['MAU'];
        $product_year=$row['NAMSX'];
        $product_meter=$row['PHANKHOI'];
        $product_qty = $row['SOLUONG'];
        $product_price=$row['GIA'];
    
        $product_brand_id=$row['MAHANG'];
        $product_type=$row['LOAIXE'];
        $product_image=$row['URL_IMAGE'];
        $p_is_active = $row['IS_ACTIVE'];
    }
?>


            <div class="edit_content mt-3">

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
                <div class="row">
                    <div class="col-md-12">



                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

                            <div class="box box-info">
                                <div class="box-body">
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class=" control-label">Tên sản phẩm </label>
                                        <input type="text" name="product_name" class="form-control"
                                            value="<?php echo $product_name; ?> " required="required">
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Màu </label>
                                        <input type="text" name="product_color" class="form-control"
                                            value="<?php echo $product_color; ?>">
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Năm sản xuất </label>
                                        <input type="text" name="product_year" class="form-control"
                                            value="<?php echo $product_year; ?>">
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Phân khối </label>
                                        <input type="text" name="product_meter" class="form-control"
                                            value="<?php echo $product_meter; ?>">
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Số lượng sản phẩm </label>
                                        <input type="text" name="product_qty" class="form-control"
                                            value="<?php echo $product_qty; ?>">
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Giá </label>
                                        <input type="text" name="product_price" class="form-control"
                                            value="<?php echo $product_price; ?>">
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Chọn hãng xe
                                        </label>
                                        <select name="product_brand" class="form-control select2">
                                            <option value="">Hãng xe</option>
                                            <?php
                                    $id=$_REQUEST['id'];
                                    $select_query="select * FROM `hangxe`";
                                    $result_query=mysqli_query($con, $select_query);

                           
                                    foreach ($result_query as $row) {
                                    $mahang=$row['MAHANG'];
                                    $tenhang=$row['TENHANG'];
                                    ?>
                                            <option value="<?php echo $mahang; ?>"
                                                <?php if($mahang == $product_brand_id){echo 'selected';} ?>>
                                                <?php echo $tenhang; ?></option>
                                            <?php
		                           }
		                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Chọn loại xe
                                        </label>
                                        <select name="product_type" class="form-control select2">
                                            <option value="">Loại xe</option>
                                            <?php
                                    $select_query="select * FROM `loaixe`";
                                    $result_query=mysqli_query($con, $select_query);

                           
                                    foreach ($result_query as $row) {
                                    $maloai=$row['LOAIXE'];
                                    $tenloai=$row['TENLOAI'];
                                    ?>
                                            <option value="<?php echo $maloai; ?>"
                                                <?php if($maloai == $product_type){echo 'selected';} ?>>
                                                <?php echo $tenloai; ?></option>
                                            <?php
		                           }
		                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Ảnh trong cơ sở dữ liệu</label>
                                        <div style="padding-top:4px;">
                                            <img src="../<?php echo $product_image; ?>" alt="" style="width:150px;"
                                                name="image">
                                            <input type="hidden" name="current_photo"
                                                <?php echo "value='".$product_image."'"?>>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Đổi ảnh </label>
                                        <div style="padding-top:4px;">
                                            <input type="file" name="new_image">
                                        </div>
                                    </div>
                                    <div class="form-outline mb-4 w-50 m-auto">
                                        <label for="" class="control-label">Hiển thị?</label>
                                        <select name="p_is_active" class="form-select" style="width: auto;">
                                            <option value="0" <?php if($p_is_active == '0'){echo 'selected';}?>>Không
                                            </option>
                                            <option value="1" <?php if($p_is_active == '1'){echo 'selected';}?>>Có
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-4 w-50 m-auto">
                                        <label for="" class="control-label"></label>
                                        <input type="submit" class="btn btn-success pull-left" name="update_btn"
                                            value="Cập nhật">
                                    </div>
                                </div>
                            </div>

                        </form>


                    </div>
                </div>

            </div>
        </div>
    </body>