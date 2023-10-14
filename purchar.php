<?php
include('./function/common_function.php');
?>
<link rel="stylesheet" href="./CSS/purchar.css">

<div class="container purchar">
    <div class="d-flex flex-row flex-1 justify-content-around my-2">
        <a href="user.php?purchar&type=-3" class="w-full border text-center btn mx-1 btn-secondary flex-fill">Tất cả</a>
        <a href="user.php?purchar&type=-2" class="w-full border text-center btn mx-1 btn-secondary flex-fill">Chờ xác
            nhận</a>
        <a href="user.php?purchar&type=0" class="w-full border text-center btn mx-1 btn-secondary flex-fill">Đang
            giao</a>
        <a href="user.php?purchar&type=1" class="w-full border text-center btn mx-1 btn-secondary flex-fill">Đã giao</a>
        <a href="user.php?purchar&type=-1" class="w-full border text-center btn mx-1 btn-secondary flex-fill">Đã hủy</a>
    </div>
    <div>
        <?php
        if(isset($_GET['type']))
        {
            if($_GET['type']==-3)
            {
                don_mua_tatca();
            }
            if($_GET['type']==-2)
            {
                don_mua(-2);
            }
            if($_GET['type']==0)
            {
                don_mua(0);
            }
            if($_GET['type']==1)
            {
                don_mua(1);
            }
            if($_GET['type']==-1)
            {
                don_mua(-1);
            }        
        }       
    ?>
    </div>
</div>