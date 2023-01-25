<?php

add_action('woocommerce_single_product_summary', ['DM_Hook_Methods', 'dm_single_product_summery'], 10);
add_action('woocommerce_single_product_summary', ['DM_Hook_Methods', 'dm_single_add_to_cart'], 20);
add_action("woocommerce_before_quantity_input_field", ['DM_Hook_Methods','dm_single_product_quantity_label'], 10);
add_action("after_setup_theme", ['DM_Hook_Methods','dm_nav_menus'],0);


