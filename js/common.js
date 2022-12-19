$(window).resize(function () {
   change_service_item_height();
   change_advantages_height();
   if ($(window).width() > 768) {
      $(".header-nav-div").show();
   } else {
      $(".header-nav-div").hide();
   }
});

function change_service_item_height() {
   $(".services-item").css("height", "auto");
   var array = $(".services-item");
   var max = 0;
   for (var i = 0; i < array.length; i++) {
      if ($(array[i]).innerHeight() > max) {
         max = $(array[i]).innerHeight();
      }
   }
   $(".services-item").innerHeight(max);
}

change_service_item_height();

function change_advantages_height() {
   $(".advantage-item").css("height", "auto");
   var array = $(".advantage-item");
   var max = 0;
   for (var i = 0; i < array.length; i++) {
      if ($(array[i]).innerHeight() > max) {
         max = $(array[i]).innerHeight();
      }
   }
   $(".advantage-item").innerHeight(max);
}

change_advantages_height();

function advantage_image_vertical_align() {
   var images = $(".advantage-item-img");
   for (var i = 0; i < images.length; i++) {
      var margin = (60 - images[i].height) / 2;
      $(images[i]).css("margin", margin + "px 0");
   }
}
advantage_image_vertical_align();

function clients_image_vertical_align() {
   var images = $(".clients-item-img");
   for (var i = 0; i < images.length; i++) {
      var margin = (100 - images[i].height) / 2;
      $(images[i]).css("margin", margin + "px 0");
   }
}
clients_image_vertical_align();

setTimeout(function () {
   change_advantages_height();
   change_service_item_height();
   advantage_image_vertical_align();
   clients_image_vertical_align();
}, 1500);

$(".header-menu-button").click(function () {
   menu_toggle();
});

var menu = document.getElementById("mobile-menu");
var menu_button = document.getElementById("mobile-menu-button");
var menu_is_open = false;
var animate_is_on = false;

document.addEventListener("click", function (event) {
   if (menu_is_open) {
      var men_contain = menu.contains(event.target);
      var men_but_contain = menu_button.contains(event.target);
      if (!men_contain && !men_but_contain) {
         menu_toggle();
      }
   }
});

function menu_toggle() {
   if (menu_is_open && !animate_is_on) {
      animate_is_on = true;
      $(".header-nav-div").slideToggle(300, function () {
         menu_is_open = false;
         animate_is_on = false;
      });
   } else if (!menu_is_open && !animate_is_on) {
      animate_is_on = true;
      $(".header-nav-div").slideToggle(300, function () {
         menu_is_open = true;
         animate_is_on = false;
      });
   }
}

$(document).on("click", ".enter-link", function () {
   $("#enter-register").show();
   $("#enter-phone").focus();
});

function close_enter_register() {
   $("#enter-register").hide();
   $(".register-block").hide();
   $(".enter-register-div").removeClass("register");
   $(".enter-register-div").addClass("enter");
   clear_enter_register_inputs();
   $(".enter-block").show();
   enter_register_status = 0;
}

// enter_register_status-es
// 0 == enter_register is hide
// 1 == .enter-block is show
// 2 == .register-block is show
// 3 == changing view
var enter_register_status = 0;

function toggle_enter_register() {
   if (enter_register_status == 0 || enter_register_status == 2) {
      enter_register_status = 3;
      $(".enter-block").hide();
      $(".enter-register-div").removeClass("enter");
      $(".enter-register-div").addClass("register");
      clear_enter_register_inputs();
      $(".register-block").show();
      $("#register-phone").focus();
      enter_register_status = 1;
   } else if (enter_register_status == 1) {
      enter_register_status = 3;
      $(".register-block").hide();
      $(".enter-register-div").removeClass("register");
      $(".enter-register-div").addClass("enter");
      clear_enter_register_inputs();
      $(".enter-block").show();
      $("#enter-phone").focus();
      enter_register_status = 2;
   }
}

/*var regex = /^[a-zA-ZА-ЯЁа-яё-!$%^&*()_+|~=`{}\[\]:";'<>?,.\/0-9]*$/;*/
var regex = /^[a-zA-ZА-ЯЁа-яё]*$/;
var regex_symbols = /[#&=?]/;
var number_regex = /^[0-9]*$/;
var checking_status = true;
var name;
var login;
var password;

function enter() {
   if (checking_status) {
      checking_status = false;
      var check1 = false;
      var check2 = false;
      $("#enter-button").html('<i class="fas fa-spinner fa-spin"></i>');
      if ($("#enter-phone").val().length >= 9) {
         if (number_regex.test($("#enter-phone").val())) {
            $("#enter-phone").css("border-color", "#7b7b64");
            $("#enter-phone").parent().find("label").html("Номер телефона:");
            login = $("#enter-phone").val();
            check1 = true;
         } else {
            $("#enter-phone").css("border-color", "#ff0000");
            $("#enter-phone")
               .parent()
               .find("label")
               .html(
                  'Номер телефона: <span style="color: #ff0000;">(Номер телефона должен состоять только из цифр!)</span>'
               );
         }
      } else {
         $("#enter-phone").css("border-color", "#ff0000");
         $("#enter-phone")
            .parent()
            .find("label")
            .html(
               'Номер телефона: <span style="color: #ff0000;">(Номер телефона должен состоять минимум из 9 цифр!)</span>'
            );
      }
      if ($("#enter-password").val().length >= 6) {
         $("#enter-password").css("border-color", "#7b7b64");
         $("#enter-password").parent().find("label").html("Пароль:");
         $(".enter-register-uncorrect").hide();
         password = $("#enter-password").val();
         check2 = true;
      } else {
         $("#enter-password").css("border-color", "#ff0000");
         $("#enter-password")
            .parent()
            .find("label")
            .html(
               'Пароль: <span style="color: #ff0000;">(Пароль должен состоять минимум из 6 символов!)</span>'
            );
      }

      if (check1 && check2) {
         $.ajax({
            type: "POST",
            data: {
               login: login,
               password: password,
            },
            url: base_url + "index.php/main/login",
            dataType: "json",
            success: function (result) {
               if (result.result == -1) {
                  $(".enter-register-uncorrect").show();
               } else {
                  $(".enter-register-uncorrect").hide();
                  window.location.href = base_url + "index.php/main/lk";
               }
               checking_status = true;
               $("#enter-button").html("Войти");
            },
            error: function (data) {},
         });
      } else {
         checking_status = true;
         $("#enter-button").html("Войти");
      }
   }
}

$("#enter-phone").keypress(function (e) {
   if (e.which === 13) {
      e.preventDefault();
      enter();
   }
});

$("#enter-password").keypress(function (e) {
   if (e.which === 13) {
      e.preventDefault();
      enter();
   }
});

function register() {
   if (checking_status) {
      var check1 = false;
      var check2 = false;
      var check3 = false;
      checking_status = false;
      $("#register-button").html('<i class="fas fa-spinner fa-spin"></i>');
      if ($("#register-phone").val().length >= 9) {
         if (number_regex.test($("#register-phone").val())) {
            $("#register-phone").css("border-color", "#7b7b64");
            $("#register-phone").parent().find("label").html("Номер телефона:");
            login = $("#register-phone").val();
            check1 = true;
         } else {
            $("#register-phone").css("border-color", "#ff0000");
            $("#register-phone")
               .parent()
               .find("label")
               .html(
                  'Номер телефона: <span style="color: #ff0000;">(Номер телефона должен состоять только из цифр!)</span>'
               );
         }
      } else {
         $("#register-phone").css("border-color", "#ff0000");
         $("#register-phone")
            .parent()
            .find("label")
            .html(
               'Номер телефона: <span style="color: #ff0000;">(Номер телефона должен состоять минимум из 9 цифр!)</span>'
            );
      }
      if ($("#register-password").val().length >= 6) {
         $("#register-password").css("border-color", "#7b7b64");
         $("#register-password").parent().find("label").html("Пароль:");
         password = $("#register-password").val();
         check2 = true;
      } else {
         $("#register-password").css("border-color", "#ff0000");
         $("#register-password")
            .parent()
            .find("label")
            .html(
               'Пароль: <span style="color: #ff0000;">(Пароль должен состоять минимум из 6 символов!)</span>'
            );
      }
      if ($("#register-name").val().length >= 1) {
         if (regex_symbols.test($("#register-name").val())) {
            $("#register-name").css("border-color", "#ff0000");
            $("#register-name")
               .parent()
               .find("label")
               .html(
                  'Ваше имя: <span style="color: #ff0000;">(Недопустимые символы!)</span>'
               );
         } else {
            $("#register-name").css("border-color", "#7b7b64");
            $("#register-name").parent().find("label").html("Ваше имя:");
            name = $("#register-name").val();
            check3 = true;
         }
      } else {
         $("#register-name").css("border-color", "#ff0000");
         $("#register-name")
            .parent()
            .find("label")
            .html(
               'Ваше имя: <span style="color: #ff0000;">(Поле имя не может быть пустым!)</span>'
            );
      }
      if (check1 && check2 && check3) {
         $.ajax({
            type: "POST",
            data: {
               login: login,
               password: password,
               name: name,
            },
            url: base_url + "index.php/main/register",
            success: function (result) {
               result = JSON.parse(result);
               if (result.result == -1) {
                  $(".register-block .enter-register-uncorrect").show();
               } else {
                  $(".register-block .enter-register-uncorrect").hide();
                  window.location.href = base_url + "index.php/main/lk";
               }
               $("#register-button").html("Регистрация");
               checking_status = true;
            },
            error: function (data) {},
         });
      } else {
         $("#register-button").html("Регистрация");
         checking_status = true;
      }
   }
}

$("#register-phone").keypress(function (e) {
   if (e.which === 13) {
      e.preventDefault();
      register();
   }
});

$("#register-password").keypress(function (e) {
   if (e.which === 13) {
      e.preventDefault();
      register();
   }
});

$("#register-name").keypress(function (e) {
   if (e.which === 13) {
      e.preventDefault();
      register();
   }
});

function clear_enter_register_inputs() {
   $("#enter-phone").val("");
   $("#enter-password").val("");
   $("#register-phone").val("");
   $("#register-password").val("");
   $("#register-name").val("");
}
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
// **********************************************************************************
(function ($) {
   "use strict";
   var iOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;

   var isMobile = {
      Android: function () {
         return navigator.userAgent.match(/Android/i);
      },
      BlackBerry: function () {
         return navigator.userAgent.match(/BlackBerry/i);
      },
      iOS: function () {
         return navigator.userAgent.match(/iPhone|iPad|iPod/i);
      },
      Opera: function () {
         return navigator.userAgent.match(/Opera Mini/i);
      },
      Windows: function () {
         return navigator.userAgent.match(/IEMobile/i);
      },
      any: function () {
         return (
            isMobile.Android() ||
            isMobile.BlackBerry() ||
            isMobile.iOS() ||
            isMobile.Opera() ||
            isMobile.Windows()
         );
      },
   };

   function parallax() {
      $(".bg--parallax").each(function () {
         var el = $(this),
            xpos = "50%",
            windowHeight = $(window).height();
         if (isMobile.any()) {
            $(this).css("background-attachment", "scroll");
         } else {
            $(window).scroll(function () {
               var current = $(window).scrollTop(),
                  top = el.offset().top,
                  height = el.outerHeight();
               if (top + height < current || top > current + windowHeight) {
                  return;
               }
               el.css(
                  "backgroundPosition",
                  xpos + " " + Math.round((top - current) * 0.2) + "px"
               );
            });
         }
      });
   }

   function backgroundImage() {
      var databackground = $("[data-background]");
      databackground.each(function () {
         if ($(this).attr("data-background")) {
            var image_path = $(this).attr("data-background");
            $(this).css({
               background: "url(" + image_path + ")",
            });
         }
      });
   }

   function siteToggleAction() {
      var navSidebar = $(".navigation--sidebar"),
         filterSidebar = $(".ps-filter--sidebar");
      $(".menu-toggle-open").on("click", function (e) {
         e.preventDefault();
         $(this).toggleClass("active");
         navSidebar.toggleClass("active");
         $(".ps-site-overlay").toggleClass("active");
      });

      $(".ps-toggle--sidebar").on("click", function (e) {
         e.preventDefault();
         var url = $(this).attr("href");
         $(this).toggleClass("active");
         $(this).siblings("a").removeClass("active");
         $(url).toggleClass("active");
         $(url).siblings(".ps-panel--sidebar").removeClass("active");
         $(".ps-site-overlay").toggleClass("active");
      });

      $("#filter-sidebar").on("click", function (e) {
         e.preventDefault();
         filterSidebar.addClass("active");
         $(".ps-site-overlay").addClass("active");
      });

      $(".ps-filter--sidebar .ps-filter__header .ps-btn--close").on(
         "click",
         function (e) {
            e.preventDefault();
            filterSidebar.removeClass("active");
            $(".ps-site-overlay").removeClass("active");
         }
      );

      $("body").on("click", function (e) {
         if ($(e.target).siblings(".ps-panel--sidebar").hasClass("active")) {
            $(".ps-panel--sidebar").removeClass("active");
            $(".ps-site-overlay").removeClass("active");
         }
      });
   }

   function subMenuToggle() {
      $(".menu--mobile .menu-item-has-children > .sub-toggle").on(
         "click",
         function (e) {
            e.preventDefault();
            var current = $(this).parent(".menu-item-has-children");
            $(this).toggleClass("active");
            current.siblings().find(".sub-toggle").removeClass("active");
            current.children(".sub-menu").slideToggle(350);
            current.siblings().find(".sub-menu").slideUp(350);
            if (current.hasClass("has-mega-menu")) {
               current.children(".mega-menu").slideToggle(350);
               current
                  .siblings(".has-mega-menu")
                  .find(".mega-menu")
                  .slideUp(350);
            }
         }
      );
      $(".menu--mobile .has-mega-menu .mega-menu__column .sub-toggle").on(
         "click",
         function (e) {
            e.preventDefault();
            var current = $(this).closest(".mega-menu__column");
            $(this).toggleClass("active");
            current.siblings().find(".sub-toggle").removeClass("active");
            current.children(".mega-menu__list").slideToggle(350);
            current.siblings().find(".mega-menu__list").slideUp(350);
         }
      );
      var listCategories = $(".ps-list--categories");
      if (listCategories.length > 0) {
         $(".ps-list--categories .menu-item-has-children > .sub-toggle").on(
            "click",
            function (e) {
               e.preventDefault();
               var current = $(this).parent(".menu-item-has-children");
               $(this).toggleClass("active");
               current.siblings().find(".sub-toggle").removeClass("active");
               current.children(".sub-menu").slideToggle(350);
               current.siblings().find(".sub-menu").slideUp(350);
               if (current.hasClass("has-mega-menu")) {
                  current.children(".mega-menu").slideToggle(350);
                  current
                     .siblings(".has-mega-menu")
                     .find(".mega-menu")
                     .slideUp(350);
               }
            }
         );
      }
   }

   function stickyHeader() {
      var header = $(".header"),
         scrollPosition = 0,
         checkpoint = 50;
      header.each(function () {
         if ($(this).data("sticky") === true) {
            var el = $(this);
            $(window).scroll(function () {
               var currentPosition = $(this).scrollTop();
               if (currentPosition > checkpoint) {
                  el.addClass("header--sticky");
               } else {
                  el.removeClass("header--sticky");
               }
            });
         }
      });

      var stickyCart = $("#cart-sticky");
      if (stickyCart.length > 0) {
         $(window).scroll(function () {
            var currentPosition = $(this).scrollTop();
            if (currentPosition > checkpoint) {
               stickyCart.addClass("active");
            } else {
               stickyCart.removeClass("active");
            }
         });
      }
   }

   function owlCarouselConfig() {
      var target = $(".owl-slider");
      if (target.length > 0) {
         target.each(function () {
            var el = $(this),
               dataAuto = el.data("owl-auto"),
               dataLoop = el.data("owl-loop"),
               dataSpeed = el.data("owl-speed"),
               dataGap = el.data("owl-gap"),
               dataNav = el.data("owl-nav"),
               dataDots = el.data("owl-dots"),
               dataAnimateIn = el.data("owl-animate-in")
                  ? el.data("owl-animate-in")
                  : "",
               dataAnimateOut = el.data("owl-animate-out")
                  ? el.data("owl-animate-out")
                  : "",
               dataDefaultItem = el.data("owl-item"),
               dataItemXS = el.data("owl-item-xs"),
               dataItemSM = el.data("owl-item-sm"),
               dataItemMD = el.data("owl-item-md"),
               dataItemLG = el.data("owl-item-lg"),
               dataItemXL = el.data("owl-item-xl"),
               dataNavLeft = el.data("owl-nav-left")
                  ? el.data("owl-nav-left")
                  : "<i class='icon-chevron-left'></i>",
               dataNavRight = el.data("owl-nav-right")
                  ? el.data("owl-nav-right")
                  : "<i class='icon-chevron-right'></i>",
               duration = el.data("owl-duration"),
               datamouseDrag = el.data("owl-mousedrag") == "on" ? true : false;
            if (
               target.children("div, span, a, img, h1, h2, h3, h4, h5, h5")
                  .length >= 2
            ) {
               el.addClass("owl-carousel").owlCarousel({
                  animateIn: dataAnimateIn,
                  animateOut: dataAnimateOut,
                  margin: dataGap,
                  autoplay: dataAuto,
                  autoplayTimeout: dataSpeed,
                  autoplayHoverPause: true,
                  loop: dataLoop,
                  nav: dataNav,
                  mouseDrag: datamouseDrag,
                  touchDrag: true,
                  autoplaySpeed: duration,
                  navSpeed: duration,
                  dotsSpeed: duration,
                  dragEndSpeed: duration,
                  navText: [dataNavLeft, dataNavRight],
                  dots: dataDots,
                  items: dataDefaultItem,
                  responsive: {
                     0: {
                        items: dataItemXS,
                     },
                     480: {
                        items: dataItemSM,
                     },
                     768: {
                        items: dataItemMD,
                     },
                     992: {
                        items: dataItemLG,
                     },
                     1200: {
                        items: dataItemXL,
                     },
                     1680: {
                        items: dataDefaultItem,
                     },
                  },
               });
            }
         });
      }
   }

   function masonry($selector) {
      var masonry = $($selector);
      if (masonry.length > 0) {
         if (masonry.hasClass("filter")) {
            masonry.imagesLoaded(function () {
               masonry.isotope({
                  columnWidth: ".grid-sizer",
                  itemSelector: ".grid-item",
                  isotope: {
                     columnWidth: ".grid-sizer",
                  },
                  filter: "*",
               });
            });
            var filters = masonry
               .closest(".masonry-root")
               .find(".ps-masonry-filter > li > a");
            filters.on("click", function (e) {
               e.preventDefault();
               var selector = $(this).attr("href");
               filters.find("a").removeClass("current");
               $(this).parent("li").addClass("current");
               $(this).parent("li").siblings("li").removeClass("current");
               $(this)
                  .closest(".masonry-root")
                  .find(".ps-masonry")
                  .isotope({
                     itemSelector: ".grid-item",
                     isotope: {
                        columnWidth: ".grid-sizer",
                     },
                     filter: selector,
                  });
               return false;
            });
         } else {
            masonry.imagesLoaded(function () {
               masonry.masonry({
                  columnWidth: ".grid-sizer",
                  itemSelector: ".grid-item",
               });
            });
         }
      }
   }

   function mapConfig() {
      var map = $("#contact-map");
      if (map.length > 0) {
         map.gmap3({
            address: map.data("address"),
            zoom: map.data("zoom"),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
         })
            .marker(function (map) {
               return {
                  position: map.getCenter(),
                  icon: "img/marker.png",
               };
            })
            .infowindow({
               content: map.data("address"),
            })
            .then(function (infowindow) {
               var map = this.get(0);
               var marker = this.get(1);
               marker.addListener("click", function () {
                  infowindow.open(map, marker);
               });
            });
      } else {
         return false;
      }
   }

   function slickConfig() {
      var product = $(".ps-product--detail");
      if (product.length > 0) {
         var primary = product.find(".ps-product__gallery"),
            second = product.find(".ps-product__variants"),
            vertical = product.find(".ps-product__thumbnail").data("vertical");
         primary.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: ".ps-product__variants",
            fade: true,
            dots: false,
            infinite: false,
            arrows: primary.data("arrow"),
            prevArrow: "<a href='#'><i class='fa fa-angle-left'></i></a>",
            nextArrow: "<a href='#'><i class='fa fa-angle-right'></i></a>",
         });
         second.slick({
            slidesToShow: second.data("item"),
            slidesToScroll: 1,
            infinite: false,
            arrows: second.data("arrow"),
            focusOnSelect: true,
            prevArrow: "<a href='#'><i class='fa fa-angle-up'></i></a>",
            nextArrow: "<a href='#'><i class='fa fa-angle-down'></i></a>",
            asNavFor: ".ps-product__gallery",
            vertical: vertical,
            responsive: [
               {
                  breakpoint: 1200,
                  settings: {
                     arrows: second.data("arrow"),
                     slidesToShow: 4,
                     vertical: false,
                     prevArrow:
                        "<a href='#'><i class='fa fa-angle-left'></i></a>",
                     nextArrow:
                        "<a href='#'><i class='fa fa-angle-right'></i></a>",
                  },
               },
               {
                  breakpoint: 992,
                  settings: {
                     arrows: second.data("arrow"),
                     slidesToShow: 4,
                     vertical: false,
                     prevArrow:
                        "<a href='#'><i class='fa fa-angle-left'></i></a>",
                     nextArrow:
                        "<a href='#'><i class='fa fa-angle-right'></i></a>",
                  },
               },
               {
                  breakpoint: 480,
                  settings: {
                     slidesToShow: 3,
                     vertical: false,
                     prevArrow:
                        "<a href='#'><i class='fa fa-angle-left'></i></a>",
                     nextArrow:
                        "<a href='#'><i class='fa fa-angle-right'></i></a>",
                  },
               },
            ],
         });
      }
   }

   function tabs() {
      $(".ps-tab-list  li > a ").on("click", function (e) {
         e.preventDefault();
         var target = $(this).attr("href");
         $(this).closest("li").siblings("li").removeClass("active");
         $(this).closest("li").addClass("active");
         $(target).addClass("active");
         $(target).siblings(".ps-tab").removeClass("active");
      });
      $(".ps-tab-list.owl-slider .owl-item a").on("click", function (e) {
         e.preventDefault();
         var target = $(this).attr("href");
         $(this)
            .closest(".owl-item")
            .siblings(".owl-item")
            .removeClass("active");
         $(this).closest(".owl-item").addClass("active");
         $(target).addClass("active");
         $(target).siblings(".ps-tab").removeClass("active");
      });
   }

   function rating() {
      $("select.ps-rating").each(function () {
         var readOnly;
         if ($(this).attr("data-read-only") == "true") {
            readOnly = true;
         } else {
            readOnly = false;
         }
         $(this).barrating({
            theme: "fontawesome-stars",
            readonly: readOnly,
            emptyValue: "0",
         });
      });
   }

   function productLightbox() {
      var product = $(".ps-product--detail");
      if (product.length > 0) {
         $(".ps-product__gallery").lightGallery({
            selector: ".item a",
            thumbnail: true,
            share: false,
            fullScreen: false,
            autoplay: false,
            autoplayControls: false,
            actualSize: false,
         });
         if (product.hasClass("ps-product--sticky")) {
            $(".ps-product__thumbnail").lightGallery({
               selector: ".item a",
               thumbnail: true,
               share: false,
               fullScreen: false,
               autoplay: false,
               autoplayControls: false,
               actualSize: false,
            });
         }
      }
      $(".ps-gallery--image").lightGallery({
         selector: ".ps-gallery__item",
         thumbnail: true,
         share: false,
         fullScreen: false,
         autoplay: false,
         autoplayControls: false,
         actualSize: false,
      });
      $(".ps-video").lightGallery({
         thumbnail: false,
         share: false,
         fullScreen: false,
         autoplay: false,
         autoplayControls: false,
         actualSize: false,
      });
   }

   function backToTop() {
      var scrollPos = 0;
      var element = $("#back2top");
      $(window).scroll(function () {
         var scrollCur = $(window).scrollTop();
         if (scrollCur > scrollPos) {
            // scroll down
            if (scrollCur > 500) {
               element.addClass("active");
            } else {
               element.removeClass("active");
            }
         } else {
            // scroll up
            element.removeClass("active");
         }

         scrollPos = scrollCur;
      });

      element.on("click", function () {
         $("html, body").animate(
            {
               scrollTop: "0px",
            },
            800
         );
      });
   }

   function modalInit() {
      var modal = $(".ps-modal");
      if (modal.length) {
         if (modal.hasClass("active")) {
            $("body").css("overflow-y", "hidden");
         }
      }
      modal.find(".ps-modal__close, .ps-btn--close").on("click", function (e) {
         e.preventDefault();
         $(this).closest(".ps-modal").removeClass("active");
      });
      $(".ps-modal-link").on("click", function (e) {
         e.preventDefault();
         var target = $(this).attr("href");
         $(target).addClass("active");
         $("body").css("overflow-y", "hidden");
      });
      $(".ps-modal").on("click", function (event) {
         if (!$(event.target).closest(".ps-modal__container").length) {
            modal.removeClass("active");
            $("body").css("overflow-y", "auto");
         }
      });
   }

   function searchInit() {
      var searchbox = $(".ps-search");
      $(".ps-search-btn").on("click", function (e) {
         e.preventDefault();
         searchbox.addClass("active");
      });
      searchbox.find(".ps-btn--close").on("click", function (e) {
         e.preventDefault();
         searchbox.removeClass("active");
      });
   }

   function countDown() {
      var time = $(".ps-countdown");
      time.each(function () {
         var el = $(this),
            value = $(this).data("time");
         var countDownDate = new Date(value).getTime();
         var timeout = setInterval(function () {
            var now = new Date().getTime(),
               distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24)),
               hours = Math.floor(
                  (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
               ),
               minutes = Math.floor(
                  (distance % (1000 * 60 * 60)) / (1000 * 60)
               ),
               seconds = Math.floor((distance % (1000 * 60)) / 1000);
            el.find(".days").html(days);
            el.find(".hours").html(hours);
            el.find(".minutes").html(minutes);
            el.find(".seconds").html(seconds);
            if (distance < 0) {
               clearInterval(timeout);
               el.closest(".ps-section").hide();
            }
         }, 1000);
      });
   }

   function productFilterToggle() {
      $(".ps-filter__trigger").on("click", function (e) {
         e.preventDefault();
         var el = $(this);
         el.find(".ps-filter__icon").toggleClass("active");
         el.closest(".ps-filter").find(".ps-filter__content").slideToggle();
      });
      if ($(".ps-sidebar--home").length > 0) {
         $(".ps-sidebar--home > .ps-sidebar__header > a").on(
            "click",
            function (e) {
               e.preventDefault();
               $(this)
                  .closest(".ps-sidebar--home")
                  .children(".ps-sidebar__content")
                  .slideToggle();
            }
         );
      }
   }

   function mainSlider() {
      var homeBanner = $(".ps-carousel--animate");
      homeBanner.slick({
         autoplay: true,
         speed: 1000,
         lazyLoad: "progressive",
         arrows: false,
         fade: true,
         dots: true,
         prevArrow: "<i class='slider-prev ba-back'></i>",
         nextArrow: "<i class='slider-next ba-next'></i>",
      });
   }

   function subscribePopup() {
      var subscribe = $("#subscribe"),
         time = subscribe.data("time");
      setTimeout(function () {
         if (subscribe.length > 0) {
            subscribe.addClass("active");
            $("body").css("overflow", "hidden");
         }
      }, time);
      $(".ps-popup__close").on("click", function (e) {
         e.preventDefault();
         $(this).closest(".ps-popup").removeClass("active");
         $("body").css("overflow", "auto");
      });
      $("#subscribe").on("click", function (event) {
         if (!$(event.target).closest(".ps-popup__content").length) {
            subscribe.removeClass("active");
            $("body").css("overflow-y", "auto");
         }
      });
   }

   function stickySidebar() {
      var sticky = $(".ps-product--sticky"),
         stickySidebar,
         checkPoint = 992,
         windowWidth = $(window).innerWidth();
      if (sticky.length > 0) {
         stickySidebar = new StickySidebar(
            ".ps-product__sticky .ps-product__info",
            {
               topSpacing: 20,
               bottomSpacing: 20,
               containerSelector: ".ps-product__sticky",
            }
         );
         if ($(".sticky-2").length > 0) {
            var stickySidebar2 = new StickySidebar(
               ".ps-product__sticky .sticky-2",
               {
                  topSpacing: 20,
                  bottomSpacing: 20,
                  containerSelector: ".ps-product__sticky",
               }
            );
         }
         if (checkPoint > windowWidth) {
            stickySidebar.destroy();
            stickySidebar2.destroy();
         }
      } else {
         return false;
      }
   }

   function accordion() {
      var accordion = $(".ps-accordion");
      accordion.find(".ps-accordion__content").hide();
      $(".ps-accordion.active").find(".ps-accordion__content").show();
      accordion.find(".ps-accordion__header").on("click", function (e) {
         e.preventDefault();
         if ($(this).closest(".ps-accordion").hasClass("active")) {
            $(this).closest(".ps-accordion").removeClass("active");
            $(this)
               .closest(".ps-accordion")
               .find(".ps-accordion__content")
               .slideUp(350);
         } else {
            $(this).closest(".ps-accordion").addClass("active");
            $(this)
               .closest(".ps-accordion")
               .find(".ps-accordion__content")
               .slideDown(350);
            $(this)
               .closest(".ps-accordion")
               .siblings(".ps-accordion")
               .find(".ps-accordion__content")
               .slideUp();
         }
         $(this)
            .closest(".ps-accordion")
            .siblings(".ps-accordion")
            .removeClass("active");
         $(this)
            .closest(".ps-accordion")
            .siblings(".ps-accordion")
            .find(".ps-accordion__content")
            .slideUp();
      });
   }

   function progressBar() {
      var progress = $(".ps-progress");
      progress.each(function (e) {
         var value = $(this).data("value");
         $(this)
            .find("span")
            .css({
               width: value + "%",
            });
      });
   }

   function select2Cofig() {
      $("select.ps-select").select2({
         placeholder: $(this).data("placeholder"),
         minimumResultsForSearch: -1,
      });
   }

   function carouselNavigation() {
      var prevBtn = $(".ps-carousel__prev"),
         nextBtn = $(".ps-carousel__next");
      prevBtn.on("click", function (e) {
         e.preventDefault();
         var target = $(this).attr("href");
         $(target).trigger("prev.owl.carousel", [1000]);
      });
      nextBtn.on("click", function (e) {
         e.preventDefault();
         var target = $(this).attr("href");
         $(target).trigger("next.owl.carousel", [1000]);
      });
   }

   function filterSlider() {
      var nonLinearSlider = document.getElementById("nonlinear");
      if (typeof nonLinearSlider != "undefined" && nonLinearSlider != null) {
         noUiSlider.create(nonLinearSlider, {
            connect: true,
            behaviour: "tap",
            start: [0, 1000],
            range: {
               min: 0,
               "10%": 100,
               "20%": 200,
               "30%": 300,
               "40%": 400,
               "50%": 500,
               "60%": 600,
               "70%": 700,
               "80%": 800,
               "90%": 900,
               max: 1000,
            },
         });
         var nodes = [
            document.querySelector(".ps-slider__min"),
            document.querySelector(".ps-slider__max"),
         ];
         nonLinearSlider.noUiSlider.on("update", function (values, handle) {
            nodes[handle].innerHTML = Math.round(values[handle]);
         });
      }
   }

   $(function () {
      backgroundImage();
      owlCarouselConfig();
      siteToggleAction();
      subMenuToggle();
      masonry(".ps-masonry");
      productFilterToggle();
      tabs();
      slickConfig();
      productLightbox();
      rating();
      backToTop();
      stickyHeader();
      mapConfig();
      modalInit();
      searchInit();
      countDown();
      mainSlider();
      parallax();
      stickySidebar();
      accordion();
      progressBar();
      select2Cofig();
      carouselNavigation();
      $('[data-toggle="tooltip"]').tooltip();
      filterSlider();
      $(".ps-product--quickview .ps-product__images").slick({
         slidesToShow: 1,
         slidesToScroll: 1,
         fade: true,
         dots: false,
         arrows: true,
         infinite: false,
         prevArrow: "<a href='#'><i class='fa fa-angle-left'></i></a>",
         nextArrow: "<a href='#'><i class='fa fa-angle-right'></i></a>",
      });
   });

   $("#product-quickview").on("shown.bs.modal", function (e) {
      $(".ps-product--quickview .ps-product__images").slick("setPosition");
   });

   $(window).on("load", function () {
      $("body").addClass("loaded");
      subscribePopup();
   });
})(jQuery);
