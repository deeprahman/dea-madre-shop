<!DOCTYPE html>
<html lang="en">

<head>

  <title><?php get_the_title() ?></title>

  <!-- meta tag header includes -->
  <meta name="author" content="<?php get_bloginfo('name') ?>" />
  <meta name="description" content="<?php get_the_excerpt() ?>" />
  <meta name="keywords" content="<?php $metaTags ?>">
  <link rel="canonical" href="<?php wp_get_canonical_url() ?>">
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/img/favicon.ico" />
  <meta name="robots" content="index, follow">

  <!-- compatability header includes -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- open graph header includes -->
  <meta property="og:title" content="<?php get_the_title() ?>" />
  <meta property="og:url" content="<?php wp_get_canonical_url() ?>" />
  <meta property="og:description" content="<?php get_the_excerpt() ?>" />

  <!-- wordpress header includes -->
  <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
  <header>
    <?php

    if (file_exists(TMPLT_DIR . DIRECTORY_SEPARATOR . 'top.htm.php')) {
      include_once(TMPLT_DIR . DIRECTORY_SEPARATOR . 'top.htm.php');
    }

    ?>
  </header>

  <?php

  if (file_exists(TMPLT_DIR . DIRECTORY_SEPARATOR . 'nav.htm.php')) {
    include_once(TMPLT_DIR . DIRECTORY_SEPARATOR . 'nav.htm.php');
  }

  ?>