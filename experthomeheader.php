<?php include 'connection.php'?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<a href="experthome.php">HOME</a>
<a href="expert_view_users.php">USERS</a>
<a href="expert_manage_forums.php">MANAGE FORUMS</a>

<a href="login.php">Logout</a>
 -->



 <!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ECO_IMPACT</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png"> -->
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/odometer.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/responsive.css?v=<?php echo time(); ?>">
</head>

<body>

    <!-- Pre-loader-start -->
    <div id="preloader">
        <div class="tg-cube-grid">
            <div class="tg-cube tg-cube1"></div>
            <div class="tg-cube tg-cube2"></div>
            <div class="tg-cube tg-cube3"></div>
            <div class="tg-cube tg-cube4"></div>
            <div class="tg-cube tg-cube5"></div>
            <div class="tg-cube tg-cube6"></div>
            <div class="tg-cube tg-cube7"></div>
            <div class="tg-cube tg-cube8"></div>
            <div class="tg-cube tg-cube9"></div>
        </div>
    </div>
    <!-- Pre-loader-end -->

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header id="home">
        <div id="header-top-fixed"></div>
        <div id="sticky-header" class="menu-area">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="flaticon-layout"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav">
                                <div class="logo">
                                    <a href="index.html"><img src="images/ECO.png" alt="Logo"></a>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-xl-flex">
                                    <ul class="navigation">
                                        <li class="active menu-item-has-children"><a href="experthome.php"
                                                class="section-link">HOME</a>

                                        </li>
                                        <li class="active menu-item-has-children"><a href="expert_view_users.php"
                                                class="section-link">USERS</a>

                                        </li>
                                        <li class="active menu-item-has-children"><a href="expert_manage_forums.php"
                                                class="section-link">FORUMS</a>

                                        </li>

                                      
                                        <li class="active menu-item-has-children"><a href="homepage.php"
                                                class="section-link">LOGOUT</a>

                                        </li>



                                    </ul>
                                </div>




                                <!-- <div class="header-action d-none d-sm-block">
                                    <ul>

                                        <li class="offCanvas-btn d-none d-xl-block"><a href="#"
                                                class="navSidebar-button"><i class="flaticon-layout"></i></a>
                                        </li>
                                    </ul>
                                </div> -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <nav class="menu-box">
                <div class="close-btn"><i class="fas fa-times"></i></div>
                <div class="nav-logo">
                    <a href="index.html"><img src="images/ECO.png" alt=""></a>
                </div>
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </div>
                <div class="social-links">
                    <!-- <ul class="clearfix">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                    </ul> -->
                </div>
            </nav>
        </div>
        <div class="menu-backdrop"></div>
        <!-- End Mobile Menu -->

        <!-- header-search -->
        <div class="search-popup-wrap" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="search-wrap text-center">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="search-form">
                                <form action="#">
                                    <input type="text" placeholder="Enter your keyword...">
                                    <button class="search-btn"><i class="flaticon-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-backdrop"></div>
        <!-- header-search-end -->

        <!-- offCanvas-start -->
        <div class="offCanvas-wrap">
            <div class="offCanvas-toggle"><img src="images/close.png" alt="icon"></div>
            <div class="offCanvas-body">
                <div class="offCanvas-content">
                    <h3 class="title">Eco-Impact: Your Path to a <span>Greener</span> Tomorrow.</h3>
                    <p>Join a community focused on reducing carbon emissions, setting eco-friendly goals, and making informed environmental decisions</p>
                </div>
                <div class="offcanvas-contact">
                    <h4 class="number"><a cl href="">Calculate</a></h4>
                    <!-- <h4 class="email">suxnix@gmail.com</h4> -->
                    <!-- <p>5689 Lotaso Terrace, Culver City, <br> CA, United States</p> -->
                    <!-- <ul class="offcanvas-social list-wrap">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul> -->
                </div>
            </div>
        </div>
        <div class="offCanvas-overlay"></div>
        <!-- offCanvas-end -->

    </header>
    <!-- header-area-end -->