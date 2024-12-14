(function ($) {
  "use strict";

  /*=============================================
	=    		 Preloader			      =
=============================================*/
  function preloader() {
    $("#preloader").delay(0).fadeOut();
  }

  /*=============================================
	=          Windows OnLoad               =
=============================================*/
  $(window).on("load", function () {
    preloader();
    mainSlider();
    wowAnimation();
  });

  /*=============================================
	=          One page Menu               =
=============================================*/
  var scrollLink = $(".section-link");
  // Active link switching
  $(window).scroll(function () {
    var scrollbarLocation = $(this).scrollTop();

    scrollLink.each(function () {
      var sectionOffset = $(this.hash).offset().top - 90;

      if (sectionOffset <= scrollbarLocation) {
        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");
      }
    });
  });
  //jQuery for page scrolling feature - requires jQuery Easing plugin
  $(function () {
    $('a.section-link[href*="#"]:not([href="#"])').on("click", function () {
      if (
        location.pathname.replace(/^\//, "") ==
          this.pathname.replace(/^\//, "") &&
        location.hostname == this.hostname
      ) {
        var target = $(this.hash);
        target = target.length
          ? target
          : $("[name=" + this.hash.slice(1) + "]");
        if (target.length) {
          $("html, body").animate(
            {
              scrollTop: target.offset().top - 80,
            },
            1200,
            "easeInOutExpo"
          );
          return false;
        }
      }
    });
  });

  /*=============================================
	=    		Mobile Menu			      =
=============================================*/
  //SubMenu Dropdown Toggle
  if ($(".menu-area li.menu-item-has-children ul").length) {
    $(".menu-area .navigation li.menu-item-has-children").append(
      '<div class="dropdown-btn"><span class="fas fa-angle-down"></span></div>'
    );
  }

  //Mobile Nav Hide Show
  if ($(".mobile-menu").length) {
    var mobileMenuContent = $(".menu-area .main-menu").html();
    $(".mobile-menu .menu-box .menu-outer").append(mobileMenuContent);

    //Dropdown Button
    $(".mobile-menu li.menu-item-has-children .dropdown-btn").on(
      "click",
      function () {
        $(this).toggleClass("open");
        $(this).prev("ul").slideToggle(500);
      }
    );
    //Menu Toggle Btn
    $(".mobile-nav-toggler").on("click", function () {
      $("body").addClass("mobile-menu-visible");
    });

    //Menu Toggle Btn
    $(
      ".menu-backdrop, .mobile-menu .close-btn, .mobile-menu .navigation li a"
    ).on("click", function () {
      $("body").removeClass("mobile-menu-visible");
    });
  }

  /*=============================================
	=          Click TO section               =
=============================================*/
  $(".header-btn a").on("click", function () {
    $("html, body").animate(
      {
        scrollTop: $("#shop").offset().top,
      },
      1200,
      "easeInOutExpo"
    );
  });

  /*=============================================
	=          Data Background               =
=============================================*/
  $("[data-background]").each(function () {
    $(this).css(
      "background-image",
      "url(" + $(this).attr("data-background") + ")"
    );
  });

  /*=============================================
	=           Data Color             =
=============================================*/
  $("[data-bg-color]").each(function () {
    $(this).css("background-color", $(this).attr("data-bg-color"));
  });

  /*=============================================
	=            Header Search            =
=============================================*/
  $(".header-search > a").on("click", function () {
    $(".search-popup-wrap").slideToggle();
    $("body").addClass("search-visible");
    return false;
  });

  $(".search-backdrop").on("click", function () {
    $(".search-popup-wrap").slideUp(500);
    $("body").removeClass("search-visible");
  });

  /*=============================================
	=     Menu sticky & Scroll to top      =
=============================================*/
  $(window).on("scroll", function () {
    var scroll = $(window).scrollTop();
    if (scroll < 245) {
      $("#sticky-header").removeClass("sticky-menu");
      $(".scroll-to-target").removeClass("open");
      $("#header-top-fixed").removeClass("header-fixed-position");
      $("#header-fixed-height").removeClass("active-height");
    } else {
      $("#sticky-header").addClass("sticky-menu");
      $(".scroll-to-target").addClass("open");
      $("#header-top-fixed").addClass("header-fixed-position");
      $("#header-fixed-height").addClass("active-height");
    }
  });

  /*=============================================
	=    		 Scroll Up  	         =
=============================================*/
  if ($(".scroll-to-target").length) {
    $(".scroll-to-target").on("click", function () {
      var target = $(this).attr("data-target");
      // animate
      $("html, body").animate(
        {
          scrollTop: $(target).offset().top,
        },
        1000
      );
    });
  }

  /*=============================================
	=          OffCanvas Active            =
=============================================*/
  $(".navSidebar-button").on("click", function () {
    $("body").addClass("offcanvas-menu-visible");
    return false;
  });

  $(".offCanvas-overlay, .offCanvas-toggle").on("click", function () {
    $("body").removeClass("offcanvas-menu-visible");
  });

  /*=============================================
	=    		 Main Slider		      =
=============================================*/
  function mainSlider() {
    var BasicSlider = $(".slider-active");
    BasicSlider.on("init", function (e, slick) {
      var $firstAnimatingElements = $(".single-slider:first-child").find(
        "[data-animation]"
      );
      doAnimations($firstAnimatingElements);
    });
    BasicSlider.on(
      "beforeChange",
      function (e, slick, currentSlide, nextSlide) {
        var $animatingElements = $(
          '.single-slider[data-slick-index="' + nextSlide + '"]'
        ).find("[data-animation]");
        doAnimations($animatingElements);
      }
    );
    BasicSlider.slick({
      autoplay: false,
      autoplaySpeed: 10000,
      dots: false,
      fade: true,
      arrows: false,
      responsive: [
        { breakpoint: 767, settings: { dots: false, arrows: false } },
      ],
    });

    function doAnimations(elements) {
      var animationEndEvents =
        "webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend";
      elements.each(function () {
        var $this = $(this);
        var $animationDelay = $this.data("delay");
        var $animationType = "animated " + $this.data("animation");
        $this.css({
          "animation-delay": $animationDelay,
          "-webkit-animation-delay": $animationDelay,
        });
        $this.addClass($animationType).one(animationEndEvents, function () {
          $this.removeClass($animationType);
        });
      });
    }
  }

  /*=============================================
	=    		Brand Active		      =
=============================================*/
  $(".brand-active").slick({
    dots: false,
    infinite: true,
    speed: 1000,
    autoplay: true,
    arrows: false,
    slidesToShow: 6,
    slidesToScroll: 2,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          arrows: false,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: false,
        },
      },
    ],
  });

  /*=============================================
	=    		Accordion Active		      =
=============================================*/
  $(function () {
    $(".accordion-collapse").on("show.bs.collapse", function () {
      $(this).parent().addClass("active-item");
      $(this).parent().prev().addClass("prev-item");
    });

    $(".accordion-collapse").on("hide.bs.collapse", function () {
      $(this).parent().removeClass("active-item");
      $(this).parent().prev().removeClass("prev-item");
    });
  });

  /*=============================================
	=    		Shop Active		      =
=============================================*/
  $(".home-shop-active").slick({
    dots: true,
    infinite: true,
    speed: 1000,
    autoplay: true,
    arrows: true,
    slidesToShow: 4,
    prevArrow:
      '<button type="button" class="slick-prev"><i class="flaticon-left-arrow"></i></button>',
    nextArrow:
      '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1500,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
    ],
  });

  /*=============================================
	=       Related Product Active      =
=============================================*/
  $(".related-product-active").slick({
    dots: true,
    infinite: true,
    speed: 1000,
    autoplay: true,
    arrows: true,
    slidesToShow: 4,
    prevArrow:
      '<button type="button" class="slick-prev"><i class="flaticon-left-arrow"></i></button>',
    nextArrow:
      '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1500,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: true,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
    ],
  });

  /*=============================================
	=         Testimonial Active          =
=============================================*/
  $(".testimonial-active").slick({
    dots: true,
    infinite: true,
    speed: 1000,
    autoplay: true,
    arrows: true,
    slidesToShow: 1,
    prevArrow:
      '<button type="button" class="slick-prev"><i class="flaticon-left-arrow"></i></button>',
    nextArrow:
      '<button type="button" class="slick-next"><i class="flaticon-right-arrow"></i></button>',
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
        },
      },
    ],
  });

  /*=============================================
	=         Testimonial Active          =
=============================================*/
  $(".testimonial-active-two").slick({
    dots: false,
    infinite: true,
    speed: 1000,
    autoplay: true,
    arrows: true,
    slidesToShow: 2,
    prevArrow: $(".prev-arrow"),
    nextArrow: $(".next-arrow"),
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
      {
        breakpoint: 575,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
        },
      },
    ],
  });

  /*=============================================
	=          easyPieChart Active          =
=============================================*/
  function easyPieChart() {
    $(".fact-item").on("inview", function (event, isInView) {
      if (isInView) {
        $(".chart").easyPieChart({
          scaleLength: 0,
          lineWidth: 6,
          trackWidth: 6,
          size: 70,
          lineCap: "round",
          rotate: 360,
          trackColor: "#F4F4F4",
          barColor: "#FAA432",
        });
      }
    });
  }
  easyPieChart();
})(jQuery);
