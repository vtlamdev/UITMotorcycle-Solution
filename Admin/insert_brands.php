<?php
include('../includes/connect_database.php');
include "header.php";
if(isset($_POST['insert_brand']) && $_POST['insert_brand'] == "Thêm hãng")
{
    $valid = 1;
    $select_query="select * from `hangxe`";
    $result_query=mysqli_query($con,$select_query);
    $number=mysqli_num_rows($result_query);
    $brand_id=$number+1;

    $brand_name=$_POST['brand_name'];
    
    // insert image
    $brand_image=$_FILES['brand_image']['name'];
    $path = $_FILES['brand_image']['name'];

    //link image
    $temp_image=$_FILES['brand_image']['tmp_name'];
    
    if($brand_name=='' or  $brand_image=='')
    {
        $valid = 0;
        $error_message = 'Bạn phải nhập đầy đủ.';
    }
    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message = 'Bạn phải tải lên file jpg, png, jpeg hoặc gif.';
        }
    }
    if($valid==1)
    {
        $select_query="select * from `hangxe` where LOWER(TENHANG)= LOWER('".$brand_name."')";
        $result_query=mysqli_query($con,$select_query);
        $number=mysqli_num_rows($result_query);
        if($number>0)
        {
            $error_message = 'Sản phẩm đã tồn tại trong cơ sở dữ liệu.';
        }
        else
        {
            $brand_urlimg="Asset/DB-Picture/".$brand_image;
            move_uploaded_file( $temp_image,'../'.$brand_urlimg);
            $insert_brand="insert into `hangxe` (MAHANG,TENHANG, URLIMAGE) values('".$brand_id."','".$brand_name."', '".$brand_urlimg."')";
            $result_query=mysqli_query($con, $insert_brand);
            if($result_query)
            {
                $success_message = 'Thêm hãng xe thành công.';
            }
            else $error_message = 'Không thể thêm hãng xe.';
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
        <title>Insert brand</title>
    </head>

    <body class="insert_brand">
        <div class="container mt-3">
            <h1 class="text-center">Thêm hãng xe</h1>
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
            <form action="" method="post" class="mb-2" enctype="multipart/form-data">
                <div class="input-group w-50 mb-2 m-auto my-4">
                    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
                    <input type="text" class="form-control" name="brand_name" placeholder="Nhập hãng xe"
                        aria-label="brands" aria-describedby="basic-addon1" required="required">
                </div>
                <div class="input-group w-50 mb-2 m-auto my-4">
                    <input type="file" name="brand_image" id="brand_image" class="form-control" required="required">
                </div>
                <div class="form-outline mb-4 w-50 m-auto my-4">
                    <input type="submit" class="btn btn-info mb-3 px-3" name="insert_brand" value="Thêm hãng"
                        placeholder="Thêm hãng" aria-label="Username" aria-describedby="basic-addon1">

                </div>
            </form>
        </div>
    </body>

</html>