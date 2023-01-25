<?php
/*
* Constants
*/

define('INC_DIR', get_template_directory() . DIRECTORY_SEPARATOR . 'includes'); //include directory

define('TMPLT_DIR', INC_DIR . DIRECTORY_SEPARATOR . 'template-parts'); // THe template parts directory

require_once INC_DIR . DIRECTORY_SEPARATOR . "woocommerce-support.inc.php"; // Configures WooCommerce theme support

// Dea Madre main classes
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-dm-utilities.php';
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-dm-dea-madre.php';

require_once INC_DIR . DIRECTORY_SEPARATOR . 'woo-breadcrumb.php'; // Modified WooCommerce Breadcrumb

$params['pages'] = require INC_DIR . DIRECTORY_SEPARATOR . 'pages.php';






$dea_madre = new DM_Dea_Madre(
      $params
);

$dea_madre->main();
