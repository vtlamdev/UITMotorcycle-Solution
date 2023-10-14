<?php include('../includes/connect_database.php');
include "header.php";?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>View brands</title>
    </head>

    <body>
        <section class="container pt-3 viewbrand_content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-body table-responsive">
                            <div id="brands_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="brands" class="table table-striped table-hover" role="grid"
                                            aria-describedby="brands_info">
                                            <thead class="thead-dark">
                                                <tr role="row" style='text-align:center'>
                                                    <th width="10" scope="col">#</th>
                                                    <th width="100" scope="col">
                                                        Ảnh</th>
                                                    <th width="100" scope="col">
                                                        Tên hãng
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select_query="SELECT * FROM `hangxe` t1 ORDER BY t1.`MAHANG` ASC";
                                                $brand_query=mysqli_query($con, $select_query);
                                                
                                                while($row=mysqli_fetch_assoc($brand_query))
                                                {
                                                    $url_img=$row['URLIMAGE'];
                                                    $mahang=$row['MAHANG'];
                                                    echo "<tr style='text-align:center'>";
                                                    echo "<td scope='row'>";
                                                    echo $mahang;
                                                    echo "</td>";
                                                    echo "<td style='width:30px;'><img src='../$url_img' style='width: 30%; height: 30%; object-fit: contain;'>";
                                                    echo "<td style='text-align:left'>";
                                                    echo $row['TENHANG'];
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
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
            $('#brands').DataTable();
        })
        </script>

    </body>

</html>