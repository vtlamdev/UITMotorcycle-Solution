<?php include('../includes/connect_database.php');
include "header.php";?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List admins</title>
    </head>

    <body>
        <section class="container pt-3 mt-3 list_admins">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body table-responsive">
                            <div id="admins_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="admins" class="table table-striped table-hover" role="grid"
                                            aria-describedby="admins_info">
                                            <thead class="thead-dark">
                                                <tr role="row" style='text-align:center'>
                                                    <th width="180" scope="col">
                                                        Tên đăng nhập
                                                    </th>
                                                    <th width="140" scope="col">
                                                        Email</th>
                                                    <th width="180" scope="col">
                                                        Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                
                                                $select_query="SELECT * FROM `taikhoan` WHERE is_admin = 1";
                                                $product_query=mysqli_query($con, $select_query);
                                                while ($row = mysqli_fetch_assoc($product_query))
                                                {
                                                    $tendangnhap = $row['tendangnhap'];
                                                    $email = $row['email'];
                                                    $MAKH = $row['MAKH'];
                                                ?>

                                                <tr style='text-align:center'>
                                                    <td><?php echo $tendangnhap; ?></td>
                                                    <td><?php echo $email; ?></td>
                                                    <td>
                                                        <div class="Action">
                                                            <a href='admin_delete.php?id=<?php echo $MAKH; ?>'
                                                                class='btn btn-sm btn-danger'
                                                                onclick="return confirm('Bạn có muốn xóa người quản trị này?');">Delete</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                
                                                    ?>

                                            </tbody>
                                        </table>
                                        <?php mysqli_close($con); ?>
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