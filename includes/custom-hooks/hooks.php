<?php

function dea_madre_display_products(){
    require_once INC_DIR . DIRECTORY_SEPARATOR . 'woocommerce_display_products.inc.php';
    // echo "The Products!";
}
add_action('dea-madre-shop-content', 'dea_madre_display_products', 10);
