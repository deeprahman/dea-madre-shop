<?php
/*
* Constants
*/

define('INC_DIR', get_template_directory() . DIRECTORY_SEPARATOR . 'includes'); //include directory

define('TMPLT_DIR', INC_DIR . DIRECTORY_SEPARATOR . 'template-parts'); // THe template parts directory

require_once INC_DIR . DIRECTORY_SEPARATOR . "woocommerce-support.inc.php"; // Configures WooCommerce theme support
require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" . DIRECTORY_SEPARATOR . 'hooks.php'; // Add custom hooks
require_once INC_DIR . DIRECTORY_SEPARATOR . "custom-hooks" .DIRECTORY_SEPARATOR . 'remove-hooks.php';

require_once INC_DIR . DIRECTORY_SEPARATOR . 'woo-breadcrumb.php'; // Modified WooCommerce Breadcrumb

require_once INC_DIR . DIRECTORY_SEPARATOR . 'abstract-page.php';
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-db-home.page.php';
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-dm-shop-page.php';






// The main class
require_once INC_DIR . DIRECTORY_SEPARATOR . 'class-dm-dea-madre.php';
$dea_madre = new DM_Dea_Madre();

add_action('after_switch_theme', 'afterSetupTheme');


$dea_madre->main();

function afterSetupTheme()
{
    createPosts('home');
    createPosts('shop');
}


function createPosts(string $title_of_the_page): int
{
    if (
        $page_obj = get_page_by_title(
            $title_of_the_page,
            'OBJECT',
            'page'
        )
    ) {
        return $page_obj->ID;
    }

    $page_id = wp_insert_post(
        array(
            // 'comment_status' => 'close',
            // 'ping_status'    => 'close',
            'post_author'    => 1,
            'post_title'     => ucwords($title_of_the_page),

            'post_status'    => 'publish',

            'post_type'      => 'page',




            //'id_of_the_parent_page_if_it_available'
        )
    );

    return $page_id;
}
