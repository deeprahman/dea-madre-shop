<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />

  <title>
   Dea Madre 
  </title>
  <?php wp_head()?>
</head>

<body>
  <header>
    <div class="top d-none  d-lg-flex flex-row justify-content-between align-items-center bg-primary text-light">
    <div role="logo" class="ms-5 me-0 my-3">

        <div class="logo" role="logo"></div>
    </div>
    <div id="top-contact" class="d-flex gap-3 flex-column justify-content-center align-items-center">
        <span class="fs-3">Forniture Coffe & Beverage</span>
        <a class="btn btn-outline-light rounded-pill contact-btn" href="#">Contact</a>
    </div>
    <dov id="user-info" class="ms-0 me-5 my-3 d-flex flex-row align-items-center">
        <div><i class="bi bi-cart text-white fs-4"></i>&nbsp;&nbsp;<span id="cart-item-num" class="fs-4">0</span></div>
        <div class="ms-3"><i class="bi bi-person-fill text-white fs-1"></i></div>
        <div class="ms-3"><i class="bi bi-facebook fs-1"></i></div>
    </dov>
</div>
      <nav class="navbar  navbar-expand-lg navbar-dark bg-primary text-light sticky-top">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand navbar-toggler" href="#" data-bs-toggle="collapse">
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
                <li class=" nav-item"><a href="#" class="nav-link">Home</a></li>
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
                    <a href="" class="nav-link dropdown-toggle" data-bs-auto-close="outside" href="#"
                        data-bs-toggle="dropdown">Shop</a>
                    <!-- Submenu -->
                    <ul class="dropdown-menu">
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
    </div>
</nav>
  </header>
  <!-- Banner section -->
  <div class="banner">
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">

      <div id="carousel-img-1" class="d-block img-size"></div>
    </div>
    <div class="carousel-item">
      
      <div id="carousel-img-2" class="d-block d-block img-size"></div>
    </div>
    <div class="carousel-item">
      <div id="carousel-img-3" class="d-block d-block img-size"></div>
    </div>
    <div class="carousel-item">
      <div id="carousel-img-4" class="d-block d-block img-size"></div>
    </div>
  </div>
</div> 
</div>
    <!-- our Shop section -->
    <section id="our-shop">
    <div class="container-fluid">
        <div class="row row-cols-1 description bg-primary shop-background-pattern pb-5 pattern">
            <div class="description-text  p-2 p-lg-5 p-md-3  bg-warning text-primary mx-auto">
                <h1 class="text-center mb-md-3">Coffee supplier Ho.Re.Ca sector
                    in Santa Maria Coghinas</h1>
                <p class="text-center">Dea Madre Coffeè & Beverage is a company operating in the distribution and sale
                    of coffee beans and in compatible single portions, craft beers, national and international wines,
                    liqueurs, spirits, spirits and snacks, for the ho.re.ca sector.
                    The company, through a professional and careful work, based on transparency, a wide range of
                    products, the great availability of staff and affordable prices has been able to establish itself
                    throughout the territory of the province of Sassari, and upper Gallura.
                    One of the company's flagship products is coffee; sold at retail or wholesale with the help of
                    equipment and merchandising and an assistance service on all equipment granted on loan for use.
                    In order to offer a wider category of products we deal with the distribution of some companies
                    producing wine and craft beers, creating in fact a direct contact between the producer and the
                    customer.</p>
                <div class="text-center mt-1 mt-md-3 mt-lg-5">
                    <a class="btn btn-outline-primary rounded-pill contact-btn" href="#">View Our Shop</a>
                </div>
            </div>
        </div>
        <div class="row product-category">
            <div class="col">
                <div class="d-flex flex-column flex-md-row gap-1 justify-content-between px-1">

                    <div id="product-coffee" class="product">

                    </div>
                    <div id="product-wines" class="product">

                    </div>
                    <div id="product-liquers" class="product">

                    </div>
                    <div id="product-beers" class="product">

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

    <section id="our-clients">

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="py-1 py-md-3 py-lg-5 d-flex flex-row flex-wrap justify-content-center gap-3 w-75 mx-auto">
                    <div class="client-block">
                        <img src="../dist/img/ca-640w.webp"  alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/daroma-640w.webp" alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/l-ariosa-640w.webp" alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/l-ariosa-640w.webp" alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/marduk-640w.webp" alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/marduk-640w.webp" alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/marduk-640w.webp" alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/marduk-640w.webp" alt="">
                    </div>
                    <div class="client-block">
                        <img src="../dist/img/marduk-640w.webp" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
    <!-- Contact Section -->
    <section id="contact" class="">
    <div class="container-fluid">
        <div class="row  text-primary pattern  p-1 p-lg-5 p-md-3">
            <div id="phone-contact" class="col-12 col-lg-6 offset-lg-3">
           

                    <div class="card bg-secondery ">
                        <div class="card-body bg-secondary text-center">
                            <p class="card-title text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" id="1258258918"
                                    class="svg u_1258258918" data-icon-name="li_phone" width="50px" height="50px">
                                    <g>
                                        <path d="M36.2,22.1v2.2c5.5,0,10,4.5,10,10h2.2C48.4,27.6,42.9,22.1,36.2,22.1z">
                                        </path>
                                        <path d="M52.4,34.3h2.2c0-4.9-1.9-9.6-5.4-13.1c-3.5-3.5-8.1-5.4-13.1-5.4V18c4.4,0,8.5,1.7,11.5,4.8C50.7,25.9,52.4,30,52.4,34.3z
            "></path>
                                        <path d="M65.1,57l-7.8,7.8L38.8,46.3l7.8-7.8l-15-15L23,32.1c-4.7,4.7-4.7,12.5,0,17.2l31.3,31.3c2.3,2.3,5.4,3.6,8.6,3.6
            c3.2,0,6.3-1.3,8.6-3.6l8.6-8.6L65.1,57z M70,79.1c-1.9,1.9-4.4,2.9-7,2.9c-2.7,0-5.2-1-7-2.9L24.6,47.8c-3.9-3.9-3.9-10.2,0-14.1
            l7-7l11.9,11.9l-7.8,7.8L57.3,68l7.8-7.8L77,72L70,79.1z"></path>
                                    </g>
                                </svg>
                            </p>
                            <p class="card-text text-center fs-3">Chiama per informazioni e preventivi per l'acquisto di
                                caffè</p>
                            <a href="#" class="btn btn-primary text-muted contact-btn rounded-pill">Contact</a>
                        </div>
                    </div>
                
            </div>
        </div>
        <div class="row row-cols-1 bg-secondary">
            <div class="col-12 col-lg-8 offset-lg-2 container">


                <div id="physical-contact" class="text-center pt-1 pt-md-3">
                    <h5>DEA MADRE COFFEE & BEVERAGE</h5>
                    <p>Viale Sardegna, 241 – 07030 Santa Maria Coghinas (SS)</p>
                    <p class="h5">+39 079 0976660 | +39 349 8185292   | deamadre.gm@gmail.com</p>
                    <p>P.I. 02731260903 | Informazioni Legali | Privacy Policy e Cookie Policy</p>
                </div>
            </div>
        </div>
    </div>
</section>
      <!-- footer section -->
      
<footer class="bg-danger dg-danger">
    <div class="container">

        <div class="row">
            <div class="col-12 col-lg-8 text-light offset-lg-2 text-center">
                <span class="">Designed by Italiaonline | Questa azienda è presente anche su</span>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer();?>
</body>

</html>