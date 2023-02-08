<?php
add_filter( 'nav_menu_link_attributes', ['DM_Hook_Methods', 'prefix_bs5_dropdown_data_attribute'], 20, 3 );
add_action( 'after_setup_theme', ['DM_Hook_Methods','register_navwalker'] );




add_action('woocommerce_single_product_summary', ['DM_Hook_Methods', 'dm_single_product_summery'], 10);
add_action('woocommerce_single_product_summary', ['DM_Hook_Methods', 'dm_single_add_to_cart'], 20);
add_action("woocommerce_before_quantity_input_field", ['DM_Hook_Methods','dm_single_product_quantity_label'], 10);


