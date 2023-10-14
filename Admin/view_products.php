<?php
include('../includes/connect_database.php');
include "header.php";
include "../function/currency_format.php";
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View products</title>
    </head>

    <body>
        <section class="container pt-3 viewproduct_content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body table-responsive">
                            <div id="products_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="products" class="table table-striped table-hover" role="grid"
                                            aria-describedby="products_info">
                                            <thead class="thead-dark">
                                                <tr role="row" style='text-align:center'>
                                                    <th width="10" scope="col">#</th>
                                                    <th width="160" scope="col">
                                                        Ảnh</th>
                                                    <th width="160" scope="col">
                                                        Tên sản phẩm
                                                    </th>
                                                    <th width="100" scope="col">
                                                        Màu</th>
                                                    <th width="70" rscope="col">
                                                        Phân khối</th>
                                                    <th width="70" rscope="col">
                                                        Số lượng</th>
                                                    <th width="80" scope="col">
                                                        Hãng</th>
                                                    <th width="150" scope="col">
                                                        Loại</th>
                                                    <th width="120" scope="col">
                                                        Năm sản xuất
                                                    </th>
                                                    <th width="80" scope="col">
                                                        Hiển thị
                                                    </th>
                                                    <th width="140" scope="col">
                                                        Giá</th>
                                                    <th width="180" scope="col">
                                                        Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                            $select_query = "SELECT *                                                           
                                                            FROM `sanpham` t1
                                                            JOIN `hangxe` t2
                                                            ON t1.`MAHANG`=t2.`MAHANG`
                                                            JOIN `loaixe` t3
                                                            ON t3.`LOAIXE`=t1.`LOAIXE`
                                                            ORDER BY t1.`MASP` ASC";
                                            $product_query = mysqli_query($con, $select_query);
                                            while ($row = mysqli_fetch_assoc($product_query)) {
                                                $masp = $row['MASP'];
                                                $url_img = $row['URL_IMAGE'];
                                            ?>
                                                <tr style='text-align:center'>
                                                    <td scope='row'><?php echo $masp; ?></td>
                                                    <td style='width:100px;'><img src='../<?php echo $url_img ?>'
                                                            style='width: 100%; height: 100%; object-fit: contain;'>
                                                    <td style='text-align:left'><?php echo $row['TENSP']; ?></td>
                                                    <td><?php echo $row['MAU']; ?></td>
                                                    <td><?php echo $row['PHANKHOI']; ?></td>
                                                    <td><?php echo $row['SOLUONG']; ?></td>
                                                    <td><?php echo $row['TENHANG']; ?></td>
                                                    <td><?php echo $row['TENLOAI']; ?></td>
                                                    <td><?php echo $row['NAMSX']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['IS_ACTIVE'] == 1) {
                                                            echo '<span class="badge badge-success" style="background-color:green;">Có</span>';
                                                        } else {
                                                            echo '<span class="badge badge-danger" style="background-color:red;">Không</span>';
                                                        }
                                                        ?>
                                                        <br>
                                                        <a style="text-decoration: none"
                                                            href="changeactive.php?id=<?php echo $row['MASP'] ?>">Đổi</a>
                                                    </td>
                                                    <td><?php echo currency_format($row['GIA']); ?> đ</td>
                                                    <td>
                                                        <div class="Action">
                                                            <a href='product_edit.php?id=<?php echo $masp ?>'
                                                                class='btn btn-sm btn-primary'>Edit</a>
                                                            <a href='product_delete.php?id=<?php echo $row['MASP']; ?>'
                                                                class='btn btn-sm btn-danger'
                                                                onclick="return confirm('Bạn có muốn xóa sản phẩm này?');">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            mysqli_close($con);
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
        <script>
        $(document).ready(function() {
            $('#products').DataTable();

        });
        </script>

    </body>

</html>