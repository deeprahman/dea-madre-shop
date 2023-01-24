<div class="top d-none  d-lg-flex flex-row justify-content-between align-items-center bg-primary text-light">
    <div role="logo" class="ms-5 me-0 my-3">

        <div class="logo" role="logo"></div>
    </div>
    <div id="top-contact" class="d-flex gap-3 flex-column justify-content-center align-items-center">
        <span class="fs-3">Forniture Coffe & Beverage</span>
        <a class="btn btn-outline-light rounded-pill contact-btn" href="#">Contact</a>
    </div>
    <dov id="user-info" class="ms-0 me-5 my-3 d-flex flex-row align-items-center">
        <div>
            <a href="<?php echo get_permalink(get_page_by_title( 'Cart' )); ?>"><i class="bi bi-cart text-white fs-4"></i></a>
            &nbsp;&nbsp;<span id="cart-item-num" class="fs-4"><?php echo wc()->cart->get_cart_contents_count() ?></span></div>
        <div class="ms-3">
            <a href="<?php echo get_permalink(get_page_by_title( 'My Account' )); ?>">

                <i class="bi bi-person-fill text-white fs-1"></i>
            </a>
        </div>
        <div class="ms-3"><i class="bi bi-facebook fs-1"></i></div>
    </dov>
</div>
