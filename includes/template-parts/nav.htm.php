<nav class="navbar sticky-top  navbar-expand-lg navbar-dark bg-primary text-light align-items-center justify-content-between  pb-0">
    <!-- <div class="container-fluid"> -->
    <button class="navbar-toggler ms-md-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="ms-5 ms-lg-0 navbar-brand navbar-toggler" href="#" data-bs-toggle="collapse">
        <span class="logo d-block"></span>
    </a>
    <div class="navbar-brand navbar-toggler" data-bs-toggle="collapse">
        <i class="bi bi-cart text-white fs-5"></i>&nbsp;&nbsp;<span id="cart-item-num" class="fs-5">0</span>
    </div>
    <?php
    wp_nav_menu(array(
        'theme_location'    => 'primary',
        'depth'             => 3,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse bg-secondary fw-normal fs-5 ps-2',
        'container_id'      => 'navbarSupportedContent',
        'menu_class'        => 'navbar-nav mx-auto',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',

    ));
    ?>

    <?php ?>
    <!-- </div> -->
</nav>