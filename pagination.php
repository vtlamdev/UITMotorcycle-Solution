<ul class="pagi_nation">
    <li <?php if($trang <= 1){ echo "class='is_disabled'"; } ?>>
        <a <?php if($trang > 1){ echo "href='$url&trang=$previous_page'"; } ?>>‹</a>
    </li>

    <?php 
        if ($tong_so_trang <= 4){  	 
            for ($counter = 1; $counter <= $tong_so_trang; $counter++){
                if ($counter == $trang) {
                    echo "<li class='is_active'><a>$counter</a></li>";	
                }else{
                    echo "<li><a href='$url&trang=$counter'>$counter</a></li>";
                }
            }
        }
        else if($tong_so_trang > 4){	
            if($trang <= 2) {			
                for ($counter = 1; $counter < 3; $counter++){		 
                    if ($counter == $trang) {
                        echo "<li class='is_active'><a>$counter</a></li>";	
                    }else{
                        echo "<li><a href='$url&trang=$counter'>$counter</a></li>";
                    }
                }
                echo "<li><a>...</a></li>";
                echo "<li><a href='$url&trang=$tong_so_trang'>$tong_so_trang</a></li>";
            }

            elseif($trang > 2 && $trang < $tong_so_trang - 1) {		 
                echo "<li><a href='$url&trang=1'>1</a></li>";
                echo "<li><a>...</a></li>";
                echo "<li class='is_active'><a>$trang</a></li>";
                echo "<li><a>...</a></li>";
                echo "<li><a href='$url&trang=$tong_so_trang'>$tong_so_trang</a></li>";      
            }
            
            else {
                echo "<li><a href='$url&trang=1'>1</a></li>";
                echo "<li><a href='$url&trang=2'>2</a></li>";
                echo "<li><a>...</a></li>";

                for ($counter = $tong_so_trang - 1; $counter <= $tong_so_trang; $counter++) {
                    if ($counter == $trang) {
                        echo "<li class='is_active'><a>$counter</a></li>";	
                    }else{
                        echo "<li><a href='$url&trang=$counter'>$counter</a></li>";
                    }                   
                }
            }
        }
    ?>

    <li <?php if($trang >= $tong_so_trang){ echo "class='is_disabled'"; } ?>>
        <a <?php if($trang < $tong_so_trang) { echo "href='$url&trang=$next_page'"; } ?>>›</a>
    </li>
    <?php if($trang < $tong_so_trang){
        echo "<li><a href='$url&trang=$tong_so_trang'>&rsaquo;&rsaquo;</a></li>";
    } ?>
</ul>