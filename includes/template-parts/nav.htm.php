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


    <div class=" collapse navbar-collapse bg-secondary fw-normal fs-5 ps-2" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <!-- Search bar on SM devices -->
            <li class=" nav-item mt-3 d-inline d-lg-none mb-4">
                <div class="search pe-2">
                    <i class="bi bi-search text-dark fw-bold fs-4"></i>
                    <input type="text" class="form-control rounded-pill fw-normal fs-4" placeholder="Search">

                </div>
            </li>
            <!-- Home -->
            <li class=" nav-item"><a href="<?php echo get_permalink(get_page_by_title('Home')); ?>" class="nav-link">Home</a></li>
            <!-- Products  -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">Products</a>
                <ul class="dropdown-menu">
                    <li><a href="#" class="dropdown-item">SubMenu</a></li>
                    <li><a href="#" class="dropdown-item">SubMenu</a></li>
                    <li><a href="#" class="dropdown-item">SubMenu</a></li>
                </ul>
            </li>
            <!-- Shop -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown">Shop</a>
                <!-- Submenu -->
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="<?php echo get_permalink(get_page_by_title('Shop')); ?>">Our Shop</a></li>
                    <!-- WIne -->
                    <li class="dropend">
                        <a class="dropdown-item dropdown-toggle" href="#"> Wine</a>
                        <!-- Sub-Submenu -->
                        <ul class="submenu dropdown-menu">
                            <li><a class="dropdown-item" href="#"> sub-submenu </a></li>
                            <li><a class="dropdown-item" href="#"> Sub-submenu </a></li>
                        </ul>
                    </li>
                    <!-- Beverage -->
                    <li> <a class="dropdown-item" href="#"> Submenu</a></li>
                    <!-- Cafeteria -->
                    <li> <a class="dropdown-item" href="#"> Submenu</a></li>
                </ul>
            </li>
            <!-- Contacts -->
            <li class=" nav-item"><a href="#" class="nav-link ">Contacts</a></li>
            <!-- Others on small devies -->
            <li class="nav-item mt-3 d-inline d-lg-none"><a href="#" class="nav-link not-highlight">
                    <i class="bi bi-cart-fill"></i>&nbsp;
                    <span>0</span>
                </a></li>
            <li class="nav-item d-inline d-lg-none"><a href="#" class="nav-link not-highlight link-light text-decoration-underline">
                    My Account
                </a></li>

        </ul>

    </div>
    <!-- </div> -->
</nav>