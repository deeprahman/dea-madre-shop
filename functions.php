<?php 
/*
* Constants
*/

define('INC_DIR',get_template_directory() . DIRECTORY_SEPARATOR . 'includes'); //include directory

define('TMPLT_DIR', INC_DIR . DIRECTORY_SEPARATOR . 'template-parts'); // THe template parts directory

require_once INC_DIR . DIRECTORY_SEPARATOR . "woocommerce-support.inc.php"; // Configures WooCommerce theme support
require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" .DIRECTORY_SEPARATOR . 'hooks.php' ; // Add custom hooks
// require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" .DIRECTORY_SEPARATOR . 'remove-hooks.php';

require_once INC_DIR . DIRECTORY_SEPARATOR . 'woo-breadcrumb.php'; // Modified WooCommerce Breadcrumb

require_once INC_DIR . DIRECTORY_SEPARATOR . 'abstract-page.php' ;
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-db-home.page.php' ;
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-dm-shop-page.php' ;



// The main class
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-dm-dea-madre.php' ;
DM_Dea_Madre::main();
 