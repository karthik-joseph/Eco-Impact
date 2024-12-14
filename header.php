<?php include 'connection.php' ?>
<?php
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>ECO IMPACT</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" href="images/icons/logo.png" width="100" height="100"/>
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS  -->
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
                                    <a href="homepage.php"><img src="images/icons/logo-green.png" alt="Logo"></a> 
                                </div>
                                <div class="navbar-wrap main-menu d-none d-xl-flex">
                                    <ul class="navigation">
                                        <li ><a href="homepage.php"
                                                class="section-link">Home</a>
                                        </li>
                                        <li>
                                            <a href="about_us.php"
                                                class="section-link">About Us</a>
                                        </li>
                                        <li>
                                            <a href="blog_post.php"
                                                class="section-link">Blog Post</a>
                                        </li>
                                        <li>
                                            <a href="support.php"
                                                class="section-link">Support</a>
                                        </li>
                                        <li><a href="login.php" class="section-link">login</a></li>

                                        <li class="menu-item-has-children"><a href="#" class="section-link no-active" style="color: #fff;">Sign Up</a>
                                            <ul class="sub-menu">
                                                <li><a href="userregistration.php">USER</a></li>
                                                <li><a href="expertregistration.php">EXPERT</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div class="header-action d-none d-sm-block">
                                    <ul>

                                        <li class="offCanvas-btn d-none d-xl-block"><a href="#"
                                                class="navSidebar-button"><i class="flaticon-layout"></i></a>
                                        </li>
                                    </ul>
                                </div>
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
            </nav>
        </div>
        <div class="menu-backdrop"></div>
        <!-- End Mobile Menu -->

        <!-- offCanvas-start -->
        <div class="offCanvas-wrap">
            <div class="offCanvas-toggle"><img src="images/close.png" alt="icon"></div>
            <div class="offCanvas-body">
                <div class="offCanvas-content">
                    <h3 class="title">Eco-Impact: Your Path to a <span>Greener</span> Tomorrow.</h3>
                    <p>Join a community focused on reducing carbon emissions, setting eco-friendly goals, and making informed environmental decisions</p>
                </div>
                <div class="offcanvas-contact">
                    <!-- <h4 class/="number"><a cl href="CALCULATE.php">Calculate</a></h4> -->
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