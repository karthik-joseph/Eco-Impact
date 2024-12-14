<?php 
    include 'connection.php';
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>

<!-- HTML -->
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ECO_IMPACT</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="images/icons/logo.png" width="100" height="100"/>
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
    <link rel="stylesheet" href="css/admin_styles.css?v=<?php echo time(); ?>" />
    <script src="js/script.js"></script>
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
                                    <a href="admin_home.php"><img src="images/icons/logo-green.png" alt="Logo"></a>  
                                </div>
                                <div class="navbar-wrap main-menu d-none d-xl-flex">
                                    <ul class="navigation">
                                        <li class="active menu-item-has-children"><a href="admin_home.php"
                                                class="section-link">Home</a>
                                        </li>
                                        <li class="active menu-item-has-children"><a href="admin_manage_category.php"
                                                class="section-link">Category</a>
                                        </li>
                                        <li class="active menu-item-has-children"><a href="admin_manage_suggestions.php"
                                                class="section-link">Suggestions</a>
                                        </li>
                                        <li class="active menu-item-has-children"><a href="admin_view_user.php"
                                                class="section-link">Users</a>
                                        </li>
                                        <li class="active menu-item-has-children"><a href="admin_view_expert.php"
                                                class="section-link">Experts</a>
                                        </li>
                                        <li class="active menu-item-has-children"><a href="admin_add_event.php"
                                                class="section-link">Event</a>
                                        </li>
                                        <li class="active menu-item-has-children"><a href="admin_manage_education_content.php" class="section-link">Educational Content</a>
                                        </li>
                                    
                                        </li>
                                        <li class="active menu-item-has-children"><a href="admin_complaint.php"
                                                class="section-link">Complaint</a>

                                        </li>
                                        <li class="active menu-item-has-children"><a href="homepage.php"
                                                class="section-link">LOGOUT</a>
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
                    <a href="admin_home.php"><img src="images/icons/logo-green.png" alt="Logo"></a>  
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
                    <h4 class="number"><a cl href="">Calculate</a></h4>
                </div>
            </div>
        </div>
        <div class="offCanvas-overlay"></div>
        <!-- offCanvas-end -->

    </header>
    <!-- header-area-end -->