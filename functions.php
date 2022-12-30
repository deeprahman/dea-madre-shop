<?php 
/*
* Constants
*/

define('INC_DIR',get_template_directory() . DIRECTORY_SEPARATOR . 'includes'); //include directory

define('TMPLT_DIR', INC_DIR . DIRECTORY_SEPARATOR . 'template-parts'); // THe template parts directory

require_once INC_DIR . DIRECTORY_SEPARATOR . "woocommerce-support.inc.php"; // Configures WooCommerce theme support
require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" .DIRECTORY_SEPARATOR . 'hooks.php' ; // Add custom hooks
require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" .DIRECTORY_SEPARATOR . 'remove-hooks.php';

  // register webpack compiled js and css with theme
  function enqueue_webpack_scripts() {
    

    $cssFileURI = get_template_directory_uri() . '/dist/css/main.min.css';
    wp_enqueue_style( 'dea-madre-css', $cssFileURI );
    

    $jsFileURI = get_template_directory_uri() . '/dist/js/main.min.js';
    wp_enqueue_script( 'dea-madre-js', $jsFileURI , null , null , true );
    
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_webpack_scripts' );