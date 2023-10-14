<?php
    if (!function_exists('currency_format')) {
        function currency_format($number) {
            if (!empty($number)) {
                return number_format($number, 0, ',', '.');
            }
        }
    }
?>


<!-- echo currency_format(5000000); -->