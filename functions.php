<?php 
/*
* Constants
*/
define('TMPLT_DIR', get_template_directory() . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'template-parts'); // THe template parts directory




  // register webpack compiled js and css with theme
  function enqueue_webpack_scripts() {
    

    $cssFileURI = get_template_directory_uri() . '/dist/css/main.min.css';
    wp_enqueue_style( 'dea-madre-css', $cssFileURI );
    

    $jsFileURI = get_template_directory_uri() . '/dist/js/main.min.js';
    wp_enqueue_script( 'dea-madre-js', $jsFileURI , null , null , true );
    
  }
  add_action( 'wp_enqueue_scripts', 'enqueue_webpack_scripts' );

?>