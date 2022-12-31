<?php
add_filter( 'woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumb_defaults' );

function custom_woocommerce_breadcrumb_defaults( $defaults ) {
  // Change the default breadcrumb home text from 'Home' to 'Shop'
  $defaults['home'] = 'Home';
  
  // Add a new breadcrumb level for product categories
  $defaults['delimiter'] = ' <span class="delimiter">&#47;</span> ';
  $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
  $defaults['wrap_after'] = '</nav>';
  $defaults['before'] = '<span class="breadcrumb-level">';
  $defaults['after'] = '</span>';
  
  return $defaults;
}

?>